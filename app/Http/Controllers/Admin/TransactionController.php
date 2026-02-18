<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {

            if ((auth()->user()->role == USER_ROLE_ADMIN) || (auth()->user()->role == USER_ROLE_STAFF)) {
                // $transactions = Transaction::with('user')->where('amount', '!=', 0)->orderByDesc('id');
                $universityId = auth()->user()->university_id;
                $transactions = Transaction::with('user', 'payment.paymentable')
                    ->where('amount', '!=', 0)
                    ->whereHas('payment', function ($paymentQuery) use ($universityId) {

                        // Courses
                        $paymentQuery->where(function ($q) use ($universityId) {
                            $q->where('paymentable_type', 'App\Models\Course')
                                ->whereHasMorph(
                                    'paymentable',
                                    [\App\Models\Course::class],
                                    function ($q2) use ($universityId) {
                                        $q2->where('university_id', $universityId);
                                    }
                                );
                        })

                        // Events
                        ->orWhere(function ($q) use ($universityId) {
                            $q->where('paymentable_type', 'App\Models\Event')
                                ->whereHasMorph(
                                    'paymentable',
                                    [\App\Models\Event::class],
                                    function ($q2) use ($universityId) {
                                        $q2->whereJsonContains('university_ids', (string)$universityId);
                                    }
                                );
                        })

                    // Appointments
                    ->orWhere(function ($q) use ($universityId) {
                        $q->where('paymentable_type', 'App\Models\Appointment')
                        ->whereHasMorph(
                            'paymentable',
                            [\App\Models\Appointment::class],
                            function ($q2) use ($universityId) {
                                // Join users table to check consultant's university_id
                                $q2->whereHas('user', function ($sub) use ($universityId) {
                                    $sub->where('university_id', $universityId);
                                });
                            }
                        );
                });

            })
            ->orderByDesc('id');
            } elseif ((int)auth()->user()->role == USER_ROLE_STUDENT) {
                // dd(auth()->user()->role);
                $transactions = Transaction::with('user')->where('amount', '!=', 0)->where('user_id', auth()->user()->id)->orderByDesc('id');
            }


            return DataTables::of($transactions)
                ->addColumn('userName', function ($transaction) {
                    return $transaction->user->name ?? 'N/A';
                })
                ->editColumn('type', function ($transaction) {
                    return getTransactionType($transaction->type);
                })
                ->editColumn('amount', function ($transaction) {
                    return showPrice($transaction->amount);
                })
                ->filterColumn('userName', function ($query, $keyword) {
                    $query->whereHas('user', function ($query) use ($keyword) {
                        $query->where('first_name', 'LIKE', "%{$keyword}%")
                            ->orWhere('last_name', 'LIKE', "%{$keyword}%");
                    });
                })
                ->filterColumn('type', function ($query, $keyword) {
                    $matchingTypes = array_keys(array_filter(getTransactionType(), function ($value) use ($keyword) {
                        return stripos($value, $keyword) !== false;
                    }));

                    if (!empty($matchingTypes)) {
                        $query->whereIn('type', $matchingTypes);
                    }
                })
                ->addColumn('action', function ($transaction) {
                    return '<div class="d-flex align-items-center g-10 justify-content-end">
                        <button onclick="getEditModal(\'' . route(getPrefix().'.transactions.details', encodeId($transaction->id)) . '\', \'#view-invoice-modal\')" type="button"
                            class="align-items-center bd-c-stroke bd-one bg-transparent d-flex h-25 justify-content-center rounded-circle w-25"
                            title="' . __('View') . '">' .
                        view('partials.icons.view')->render() .
                        '</button></div>';
                })
                ->make(true);
        }

        $data['pageTitle'] = __('All Transactions');
        $data['activeTransaction'] = 'active';

        return view('admin.transactions.index', $data);

    }

    public function invoiceDetails($id)
    {
        $data['transaction'] = Transaction::where('id',decodeId($id))->with('payment')->first();

        return view('admin.transactions.invoice-details', $data);
    }

    public function invoicePrint($id)
    {
        $data['title'] = __('Invoice Print');
        $data['transaction'] = Transaction::where('id',decodeId($id))->with('payment')->first();
        return view('admin.transactions.print-invoice', $data);
    }
}
