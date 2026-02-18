@extends('frontend.layouts.app')
@push('title')
    {{ __('Home') }}
@endpush
@section('content')
    <!-- Breadcrumb -->
    <section class="inner-breadcrumb-section">
        
            <div class="inner-breadcrumb-wrap" data-aos="fade-up" data-aos-duration="1000">
            <h4 class="inner-breadcrumb-title">{{__('Malayalam University - Credit Transfer Information')}}</h4>
            <ol class="breadcrumb inner-breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('frontend')}}">{{__('Home')}}</a></li>
                <li class="breadcrumb-item"><a href="/transfer-credits">{{__('Credit Transfer Information')}}</a></li>
            </ol>
        </div>
        
    </section>
    <div class="credit_container">
        
        <!-- Introduction -->
        <div class="credit_intro">
            <p>
                <i class="fas fa-info-circle me-2"></i>
                This page describes how Malayalam University awards credits for the studies completed. 
                You can use the courses you already completed in an accredited institution anywhere in the world 
                from an accredited institution to acquire the credits required for graduation.
            </p>
        </div>

        <!-- Main Content -->
        <h2 class="credit_heading_main">Evaluation of International Credits for Graduation at a Florida University</h2>
        
        <p class="credit_text">
            Florida universities, such as the University of Miami, Florida International University (FIU), 
            or the University of Florida (UF), have established processes to evaluate and apply credits earned 
            from international universities toward undergraduate degree requirements.
        </p>

        <!-- Submission of Documents -->
        <h3 class="credit_heading_sub">Submission of Required Documents</h3>
        <p class="credit_text">To begin the evaluation process, students must submit the following:</p>
        
        <ul class="credit_list">
            <li><strong>Official Transcripts:</strong> Original or certified copies sent directly from the institution</li>
            <li><strong>Certified English Translations:</strong> Word-for-word translations if not in English</li>
            <li><strong>Degree Certificates:</strong> Official diploma or graduation certificate if awarded</li>
            <li><strong>Course Syllabi:</strong> Detailed course descriptions for content assessment</li>
        </ul>

        <!-- NACES Evaluation -->
        <h3 class="credit_heading_sub">Credential Evaluation by a NACES Member</h3>
        <p class="credit_text">
            Most Florida universities require evaluation by NACES members such as Josef Silny & Associates, 
            World Education Services (WES), or SpanTran. The evaluation determines:
        </p>
        
        <div class="credit_card_grid">
            <div class="credit_card">
                <div class="credit_icon_box">
                    <i class="fas fa-certificate"></i>
                </div>
                <h5>U.S. Degree Equivalency</h5>
                <p>Whether the international degree is comparable to a U.S. bachelor's degree.</p>
            </div>
            <div class="credit_card">
                <div class="credit_icon_box">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h5>Course-by-Course Analysis</h5>
                <p>Detailed breakdown of courses, credits, grades, and U.S. equivalents.</p>
            </div>
            <div class="credit_card">
                <div class="credit_icon_box">
                    <i class="fas fa-university"></i>
                </div>
                <h5>Institution Accreditation</h5>
                <p>Institution must be recognized by country's Ministry of Education.</p>
            </div>
        </div>

        <!-- Credit Transfer Criteria -->
        <h3 class="credit_heading_sub">Credit Transfer Criteria</h3>
        
        <h5 class="credit_heading_small">Accreditation and Recognition</h5>
        <p class="credit_text">Institution must be accredited by its country's Ministry of Education. Non-accredited, technical, vocational, or remedial programs typically not transferable.</p>
        
        <h5 class="credit_heading_small">Course Comparability</h5>
        <p class="credit_text">Courses assessed for equivalence in content, rigor, and learning outcomes.</p>
        
        <h5 class="credit_heading_small">Grade Requirements</h5>
        <p class="credit_text">Minimum grade equivalent to U.S. "C" or better generally required.</p>
        
        <h5 class="credit_heading_small">Credit Conversion</h5>
        <p class="credit_text">Credits converted to U.S. semester system:</p>
        
        <div class="credit_info_row">
            <span class="credit_badge">China: 0.6–0.7 ratio</span>
            <span class="credit_badge">Korea: 0.9 ratio</span>
            <span class="credit_badge">ECTS: 0.5 ratio</span>
        </div>

        <div class="credit_highlight">
            <strong><i class="fas fa-exclamation-triangle me-2"></i>Non-Transferable Courses:</strong> Remedial, ESL, military, or vocational courses typically not accepted.
        </div>

        <!-- Application Toward Graduation -->
        <h3 class="credit_heading_sub">Application Toward Graduation Requirements</h3>
        
        <div class="row">
            <div class="col-md-4">
                <div class="credit_block">
                    <div class="credit_icon_box">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h5 class="credit_heading_small">General Education</h5>
                    <p>May fulfill gen ed requirements if deemed equivalent.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="credit_block">
                    <div class="credit_icon_box">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h5 class="credit_heading_small">Major/Minor</h5>
                    <p>Departments evaluate if courses meet requirements.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="credit_block">
                    <div class="credit_icon_box">
                        <i class="fas fa-puzzle-piece"></i>
                    </div>
                    <h5 class="credit_heading_small">Electives</h5>
                    <p>Count as general electives toward 120 credits.</p>
                </div>
            </div>
        </div>

        <!-- Additional Considerations -->
        <h3 class="credit_heading_sub">Additional Considerations</h3>
        
        <div class="row">
            <div class="col-md-6">
                <h5 class="credit_heading_small">English Proficiency</h5>
                <p class="credit_text">TOEFL, IELTS, or Duolingo scores may be needed if instruction wasn't in English.</p>
                
                <h5 class="credit_heading_small">Credit Limits</h5>
                <p class="credit_text">Universities often cap transferable credits at 60 hours.</p>
            </div>
            
            <div class="col-md-6">
                <h5 class="credit_heading_small">Graduation Tracking</h5>
                <p class="credit_text">Students responsible for monitoring progress toward graduation.</p>
                
                <h5 class="credit_heading_small">Processing Time</h5>
                <p class="credit_text">Evaluations can take several weeks, especially with additional documentation.</p>
            </div>
        </div>

        <div class="credit_divider"></div>

        <!-- Understanding Credit System -->
        <h2 class="credit_heading_main">Understanding the Credit System in U.S. Universities</h2>
        
        <h3 class="credit_heading_sub">What Are Credits?</h3>
        <p class="credit_text">
            <i class="fas fa-question-circle me-2"></i>
            Credits represent the academic value of a course based on time spent in instruction and study. 
            One credit hour = one hour of classroom instruction per week for 15-week semester, plus 2-3 hours 
            of outside work. A 3-credit course involves ~3 hours classroom time and 6-9 hours outside work weekly.
        </p>

        <div class="credit_stats">
            <div class="credit_stat_item">
                <div class="credit_stat_number">3-4</div>
                <div class="credit_stat_label">Credit Hours<br>per Course</div>
            </div>
            <div class="credit_stat_item">
                <div class="credit_stat_number">12-18</div>
                <div class="credit_stat_label">Credits for<br>Full-Time</div>
            </div>
            <div class="credit_stat_item">
                <div class="credit_stat_number">120</div>
                <div class="credit_stat_label">Credits for<br>Bachelor's</div>
            </div>
        </div>

        <!-- Types of Credits -->
        <h3 class="credit_heading_sub">Types of Credits</h3>
        
        <div class="row">
            <div class="col-md-6">
                <div class="credit_block">
                    <h5 class="credit_heading_small">Semester Credits</h5>
                    <p>Fall and spring terms, ~15-16 weeks each.</p>
                </div>
                <div class="credit_block">
                    <h5 class="credit_heading_small">Quarter Credits</h5>
                    <p>10-week terms. Converted by multiplying by 0.67.</p>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="credit_block">
                    <h5 class="credit_heading_small">Transfer Credits</h5>
                    <p>From other institutions after evaluation with minimum grade "C".</p>
                </div>
                <div class="credit_block">
                    <h5 class="credit_heading_small">Advanced Credits</h5>
                    <p>Through AP, IB, or CLEP exams, subject to approval.</p>
                </div>
            </div>
        </div>

        <!-- Minimum Credits -->
        <h3 class="credit_heading_sub">Minimum Credits for Graduation</h3>
        
        <div class="credit_block">
            <h5><i class="fas fa-trophy me-2"></i>Bachelor's Degree Requirements: 120 Credits</h5>
            <div class="mt-3">
                <span class="credit_badge">General Education: 30–40 credits</span>
                <span class="credit_badge">Major Requirements: 30–60 credits</span>
                <span class="credit_badge">Electives: 20–40 credits</span>
                <span class="credit_badge">Residency: 30–60 credits</span>
            </div>
        </div>

        <h4 class="credit_heading_small"><i class="fas fa-building me-2"></i>Florida Universities Examples</h4>
        <div class="credit_resource_grid">
            <div class="credit_resource_card">
                <h5>University of Florida</h5>
                <p>120 credits<br>60 at 3000+ level</p>
            </div>
            <div class="credit_resource_card">
                <h5>Florida International University</h5>
                <p>120 credits<br>30 in residence</p>
            </div>
            <div class="credit_resource_card">
                <h5>University of Miami</h5>
                <p>120 credits<br>45 upper-division</p>
            </div>
            <div class="credit_resource_card">
                <h5>Florida State University</h5>
                <p>120 credits<br>30 at FSU</p>
            </div>
        </div>

        <div class="credit_divider"></div>

        <!-- Indian Credits -->
        <h2 class="credit_heading_main">Evaluation Process for Indian Credits</h2>

        <h3 class="credit_heading_sub">1. Submission of Documents</h3>
        <ul class="credit_list">
            <li>Official Transcripts from Indian university</li>
            <li>Degree Certificate if completed</li>
            <li>Certified English Translations (Hindi, Malayalam, etc.)</li>
            <li>Course Syllabi with topics and contact hours</li>
            <li>Proof of UGC/AICTE Accreditation</li>
        </ul>

        <h3 class="credit_heading_sub">2. NACES Evaluation</h3>
        <p class="credit_text">Evaluation by WES, Josef Silny & Associates, SpanTran, or ECE</p>
        
        <div class="row">
            <div class="col-md-8">
                <div class="credit_block">
                    <h5 class="credit_heading_small">Evaluation Types:</h5>
                    <ul class="credit_list">
                        <li><strong>Course-by-Course:</strong> Detailed breakdown with U.S. equivalents</li>
                        <li><strong>Document-by-Document:</strong> Verifies degree equivalency</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="credit_card">
                    <div class="credit_icon_box">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h5>Cost & Time</h5>
                    <p><strong>$100–$250</strong><br>2–8 weeks</p>
                </div>
            </div>
        </div>

        <h3 class="credit_heading_sub">3. Credit Conversion</h3>
        
        <div class="credit_info_row">
            <p><strong><i class="fas fa-calculator me-2"></i>Contact Hour Analysis:</strong> Indian courses with 45–60 contact hours = 3 U.S. credits</p>
        </div>

        <div class="credit_info_row">
            <p><strong><i class="fas fa-exchange-alt me-2"></i>Credit Ratio:</strong> Indian credits × 0.6–0.7 = U.S. semester credits</p>
        </div>

        <div class="credit_info_row">
            <p><strong><i class="fas fa-calendar-alt me-2"></i>3-Year vs. 4-Year:</strong> 3-year degrees may need additional coursework. 4-year degrees (B.Tech) generally recognized.</p>
        </div>

        <h3 class="credit_heading_sub">4. Course Equivalency</h3>
        
        <div class="credit_card_grid">
            <div class="credit_card">
                <h5><i class="fas fa-book me-2"></i>General Education</h5>
                <p>Math, sciences, humanities if equivalent to U.S. outcomes</p>
            </div>
            <div class="credit_card">
                <h5><i class="fas fa-microscope me-2"></i>Major Requirements</h5>
                <p>Department reviews syllabi for matches</p>
            </div>
            <div class="credit_card">
                <h5><i class="fas fa-clipboard-list me-2"></i>Electives</h5>
                <p>Non-equivalent courses as general electives</p>
            </div>
        </div>

        <!-- Steps for Students -->
        <h3 class="credit_heading_sub">Steps for Students</h3>
        
        <div class="credit_block">
            <ol class="credit_list">
                <li>Verify UGC/AICTE accreditation</li>
                <li>Gather transcripts, certificates, syllabi, translations</li>
                <li>Choose NACES evaluator (WES, Josef Silny)</li>
                <li>Submit evaluation and transcripts to university</li>
                <li>Consult advisors to map credits</li>
                <li>Track progress via degree audit system</li>
            </ol>
        </div>

        <!-- Example -->
        <h3 class="credit_heading_sub">Example Conversion</h3>
        <div class="credit_example_box">
            <p><strong><i class="fas fa-flask me-2"></i>Indian Course:</strong> "Introduction to Physics" (4 credits, 60 hours, 75%)</p>
            <p><strong><i class="fas fa-check-circle me-2"></i>Evaluation:</strong> 3 U.S. credits, Grade B (3.0/4.0)</p>
            <p><strong><i class="fas fa-star me-2"></i>Application:</strong> Fulfills 3 credits general education (natural sciences)</p>
        </div>

        <!-- Resources -->
        <h3 class="credit_heading_sub">Resources</h3>
        <div class="credit_resource_grid">
            <div class="credit_resource_card">
                <h5><i class="fas fa-link me-2"></i>Evaluation Services</h5>
                <p>naces.org/members<br>wes.org<br>jsilny.org</p>
            </div>
            <div class="credit_resource_card">
                <h5><i class="fas fa-check-double me-2"></i>Verification</h5>
                <p>ugc.ac.in<br>University admissions offices</p>
            </div>
        </div>

        <!-- Conclusion -->
        <div class="credit_conclusion">
            <p style="margin: 0;"><strong><i class="fas fa-lightbulb me-2"></i>Conclusion:</strong> By following these steps and providing complete documentation, students can successfully transfer courses from Indian universities to U.S. institutions, ensuring credits contribute to their degree requirements.</p>
        </div>


    </div>
        <style>
        :root {
            --credit-primary: #8B1538;
            --credit-secondary: #A01D47;
            --credit-accent: #C7254E;
            --credit-light: #FFF5F7;
            --credit-dark: #2C1810;
            --credit-gold: #D4AF37;
        }



        .credit_header {
            background: linear-gradient(135deg, var(--credit-primary) 0%, var(--credit-secondary) 50%, var(--credit-accent) 100%);
            color: white;
            padding: 4rem 0;
            box-shadow: 0 4px 20px rgba(139, 21, 56, 0.3);
            position: relative;
            overflow: hidden;
        }

        .credit_header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: credit_float 6s ease-in-out infinite;
        }

        @keyframes credit_float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .credit_header h1 {
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            margin-bottom: 0.5rem;
        }

        .credit_header p {
            font-size: 1.2rem;
            opacity: 0.95;
        }

        .credit_container {
            background: white;
            margin: -2rem auto 3rem;
            max-width: 1200px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 3rem;
            position: relative;
        }

        .credit_intro {
            background: linear-gradient(135deg, var(--credit-light) 0%, #FFE5E9 100%);
            padding: 2rem;
            border-radius: 15px;
            border-left: 5px solid var(--credit-primary);
            margin-bottom: 3rem;
            box-shadow: 0 4px 15px rgba(139, 21, 56, 0.1);
        }

        .credit_intro p {
            margin: 0;
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
        }

        .credit_heading_main {
            color: var(--credit-primary);
            font-weight: 700;
            font-size: 2.5rem;
            margin-top: 3rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 4px solid var(--credit-primary);
            position: relative;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
        }

        .credit_heading_main::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100px;
            height: 4px;
            background: var(--credit-gold);
        }

        .credit_heading_sub {
            color: var(--credit-secondary);
            font-weight: 600;
            font-size: 1.8rem;
            margin-top: 2.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .credit_heading_sub::before {
            content: '';
            width: 8px;
            height: 40px;
            background: linear-gradient(to bottom, var(--credit-primary), var(--credit-accent));
            border-radius: 4px;
        }

        .credit_heading_small {
            color: var(--credit-dark);
            font-weight: 600;
            font-size: 1.3rem;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .credit_heading_small::before {
            content: '▸';
            color: var(--credit-accent);
            font-size: 1.5rem;
        }

        .credit_list {
            list-style: none;
            padding-left: 0;
        }

        .credit_list li {
            margin-bottom: 1rem;
            padding-left: 2rem;
            position: relative;
            line-height: 1.8;
        }

        .credit_list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--credit-primary);
            font-weight: bold;
            font-size: 1.2rem;
        }

        .credit_list ol {
            counter-reset: item;
            list-style: none;
            padding-left: 0;
        }

        .credit_list ol li {
            counter-increment: item;
            padding-left: 2.5rem;
        }

        .credit_list ol li::before {
            content: counter(item);
            position: absolute;
            left: 0;
            background: linear-gradient(135deg, var(--credit-primary), var(--credit-accent));
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .credit_block {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 2rem;
            margin-bottom: 2rem;
            border-radius: 15px;
            border: 1px solid #e9ecef;
            border-left: 5px solid var(--credit-primary);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .credit_block::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(139, 21, 56, 0.05) 0%, transparent 70%);
            border-radius: 50%;
        }

        .credit_block:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(139, 21, 56, 0.15);
            border-left-color: var(--credit-accent);
        }

        .credit_highlight {
            background: linear-gradient(135deg, #FFF9E6 0%, #FFE082 100%);
            padding: 1.5rem;
            border-radius: 12px;
            border-left: 5px solid var(--credit-gold);
            margin: 2rem 0;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.2);
            position: relative;
        }

        .credit_highlight::before {
            content: '⚠';
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            font-size: 2rem;
            opacity: 0.3;
        }

        .credit_highlight strong {
            color: #996A00;
        }

        .credit_card_grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .credit_card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border-top: 4px solid var(--credit-primary);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .credit_card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--credit-primary), var(--credit-accent), var(--credit-gold));
            transition: height 0.3s ease;
        }

        .credit_card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(139, 21, 56, 0.2);
        }

        .credit_card:hover::before {
            height: 100%;
            opacity: 0.05;
        }

        .credit_card h5 {
            color: var(--credit-primary);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .credit_icon_box {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--credit-primary), var(--credit-accent));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 10px rgba(139, 21, 56, 0.3);
        }

        .credit_badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--credit-primary), var(--credit-accent));
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin: 0.25rem;
            box-shadow: 0 2px 8px rgba(139, 21, 56, 0.3);
        }

        .credit_info_row {
            background: linear-gradient(to right, var(--credit-light), white);
            padding: 1.5rem;
            border-radius: 10px;
            margin: 1rem 0;
            border-left: 3px solid var(--credit-accent);
        }

        .credit_text {
            line-height: 1.9;
            text-align: justify;
            margin-bottom: 1.2rem;
            color: #555;
        }

        .credit_divider {
            height: 3px;
            background: linear-gradient(to right, transparent, var(--credit-primary), transparent);
            margin: 3rem 0;
            border-radius: 2px;
        }

        .credit_stats {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 2rem;
            margin: 3rem 0;
            padding: 2rem;
            background: linear-gradient(135deg, var(--credit-light) 0%, white 100%);
            border-radius: 15px;
        }

        .credit_stat_item {
            text-align: center;
        }

        .credit_stat_number {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--credit-primary), var(--credit-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .credit_stat_label {
            color: #666;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        .credit_example_box {
            background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
            padding: 2rem;
            border-radius: 15px;
            border-left: 5px solid #2196F3;
            margin: 2rem 0;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.2);
        }

        .credit_example_box p {
            margin-bottom: 0.5rem;
        }

        .credit_resource_grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .credit_resource_card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            border: 2px solid var(--credit-light);
            transition: all 0.3s ease;
        }

        .credit_resource_card:hover {
            border-color: var(--credit-primary);
            transform: translateY(-3px);
        }

        .credit_resource_card h5 {
            color: var(--credit-primary);
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .credit_conclusion {
            background: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%);
            padding: 2rem;
            border-radius: 15px;
            border-left: 5px solid #4CAF50;
            margin: 3rem 0;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.2);
        }

        .credit_footer {
            text-align: center;
            padding: 2rem 0;
            color: #666;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .credit_header h1 {
                font-size: 2rem;
            }
            
            .credit_container {
                padding: 1.5rem;
                margin-top: -1rem;
            }

            .credit_heading_main {
                font-size: 1.8rem;
            }

            .credit_heading_sub {
                font-size: 1.4rem;
            }

            .credit_card_grid {
                grid-template-columns: 1fr;
            }
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Selection color */
        ::selection {
            background: var(--credit-accent);
            color: white;
        }
    </style>
@endsection
