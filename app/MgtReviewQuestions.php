<?php

namespace App;

class MgtReviewQuestions
{
    /**
     * The Management Review: twelve plain-language questions covering ISO 9001,
     * 14001 and 45001, then the decisions, the objectives, the actions and the
     * meeting files, as the client wrote them.
     *
     * Each question carries:
     *   no      the number shown in the circle
     *   part    1 or 2, the part of the form it sits under
     *   title   the question itself
     *   badges  which standards it covers - All standards / Quality / Environment / H&S
     *   bring   the "what to bring" lines; each is [text, tags] and a tag marks a
     *           line that only applies under that standard
     *   where   "where to look"; each is [label, route, suffix] and a null route
     *           means it is not a page on this site, so it is written as plain text
     *   eg      the "a good answer looks like" example
     *   ph      the placeholder in the answer box
     *
     * The answers live in tbl_mgtreview_answers, one row per question, so the
     * sixteen old columns on tbl_mgtreviews are left untouched and every review
     * recorded before this form still reads back in full.
     */
    public static function all()
    {
        return [
            [
                'no' => 1,
                'part' => 1,
                'title' => 'Were the actions from the last review completed?',
                'badges' => ['All standards'],
                'bring' => [
                    ['The actions list from your last Management Review.', []],
                    ['For each action: done, not done, or still in progress.', []],
                    ['Actions agreed to help reach your objectives: are they done?', []],
                    ['For anything not done: the reason, and a new date.', []],
                ],
                'where' => [
                    ['Management Reviews', 'add_management_review', '(your last review)'],
                    ['Objectives Tracker', 'objectives_tracker', '(actions for each objective)'],
                ],
                'eg' => '8 of 10 actions done, including both actions for the waste objective. Fire drill moved to Nov 2026 because the contractor was late. New supplier list still in progress (Ali Khan, due Dec 2026).',
                'ph' => 'Write your answer here. If this is your first review, write First review.',
            ],
            [
                'no' => 2,
                'part' => 1,
                'title' => 'What has changed inside or outside the business?',
                'badges' => ['All standards'],
                'bring' => [
                    ['Inside: new services, sites, staff, equipment or software.', []],
                    ['Outside: customers, competitors, the economy, or what your interested parties now need.', []],
                    ['New or changed environmental laws, permits or impacts.', ['Environment']],
                    ['New hazards, new safety laws, or changes to how work is done.', ['H&S']],
                ],
                'where' => [
                    ['Interested Parties', 'interesting_parties', ''],
                    ['Environmental Impacts', 'environmental_impacts', ''],
                    ['Hazard Register', 'hazards', ''],
                ],
                'eg' => 'Opened a second site in Sharjah (Mar 2026). Two new healthcare customers need faster delivery. The new site needs its own waste permit.',
                'ph' => 'Write your answer here. If this question does not apply to you, write N/A.',
            ],
            [
                'no' => 3,
                'part' => 1,
                'title' => 'What are customers, workers and others telling you?',
                'badges' => ['All standards'],
                'bring' => [
                    ['Customer feedback: reviews, surveys, compliments and complaints.', []],
                    ['Anything your interested parties have asked for or raised.', []],
                    ['What workers raised about safety, for example at toolbox talks or safety meetings.', ['H&S']],
                    ['Comments or complaints from neighbours, the council or regulators.', ['Environment']],
                ],
                'where' => [
                    ['Customer Reviews', 'customer_review', ''],
                    ['Non-Conformities', 'non_confromities', '(complaints)'],
                    ['Interested Parties', 'interesting_parties', ''],
                ],
                'eg' => 'Customer reviews average 4.5 out of 5. 3 complaints about late delivery, all closed. Workers asked for better lighting in the warehouse. No complaints from neighbours.',
                'ph' => 'Write your answer here. If this question does not apply to you, write N/A.',
            ],
            [
                'no' => 4,
                'part' => 1,
                'title' => "How did you do against last year's objectives?",
                'badges' => ['All standards'],
                'bring' => [
                    ['Each objective: met, not met, or still in progress, with the latest figure.', []],
                    ['If not met: why, and whether to keep it, change it or drop it.', []],
                    ['One line for each standard you hold.', ['Quality', 'Environment', 'H&S']],
                ],
                'where' => [
                    ['Objectives Tracker', 'objectives_tracker', ''],
                ],
                'eg' => 'Quality: 96% of orders on time (target 95%), met. Environment: waste down 9% (target 15%), not met, kept for next year. H&S: no lost-time accidents, met.',
                'ph' => 'Write your answer here. If this question does not apply to you, write N/A.',
            ],
            [
                'no' => 5,
                'part' => 1,
                'title' => 'Is the work going as planned, and what do the figures show?',
                'badges' => ['All standards'],
                'bring' => [
                    ['Are your main processes giving the results you expect? For example, orders on time or jobs right first time.', []],
                    ['Measuring equipment is calibrated, and regular checks are up to date.', []],
                    ['Energy, water and waste figures, compared with last year.', ['Environment']],
                    ['Safety figures: accidents, near misses, days lost, inspections done.', ['H&S']],
                ],
                'where' => [
                    ['Process Flow Charts', 'sale_processes', ''],
                    ['Calibration', 'calibration_record', ''],
                    ['Requirements Due', 'requirements_aspect', ''],
                    ['Dashboard', 'home', ''],
                ],
                'eg' => '98% of orders delivered on time. All 12 instruments in calibration. Electricity down 6% on last year. 1 minor accident, 7 near misses reported, 12 of 12 site inspections done.',
                'ph' => 'Write your answer here. If this question does not apply to you, write N/A.',
            ],
            [
                'no' => 6,
                'part' => 1,
                'title' => 'What went wrong, and did the fixes work?',
                'badges' => ['All standards'],
                'bring' => [
                    ['Problems and complaints recorded since the last review, and how many are still open.', []],
                    ['Did each fix stop the problem coming back?', []],
                    ['Incidents and near misses, and what was learned from them.', ['H&S']],
                    ['Spills, leaks or other environmental incidents.', ['Environment']],
                ],
                'where' => [
                    ['Non-Conformities', 'non_confromities', ''],
                    ['Incident Report', 'incidents', ''],
                ],
                'eg' => '14 non-conformities, 12 closed, 2 open (due Nov 2026). Labelling errors stopped after the new checklist. 1 small oil spill, cleaned up, drip trays added.',
                'ph' => 'Write your answer here. If this question does not apply to you, write N/A.',
            ],
            [
                'no' => 7,
                'part' => 2,
                'title' => 'What did your audits find?',
                'badges' => ['All standards'],
                'bring' => [
                    ['The process audits done this year, and what they found.', []],
                    ['Your last QMS Audit and its results.', []],
                    ["The external auditor's report and comments, and whether each point was dealt with.", []],
                ],
                'where' => [
                    ['Process Audits', 'process_audit', ''],
                    ['QMS Audits', 'qms_audit', ''],
                    ['Dashboard', 'home', '(Supporting Documents: Audit Report, Auditor Comments)'],
                ],
                'eg' => '6 process audits done, 4 small findings, all closed. QMS Audit Aug 2026: 15 YES, 2 NO (training records, list of laws), both now fixed. Last external audit: 1 minor finding, closed.',
                'ph' => 'Write your answer here. If this question does not apply to you, write N/A.',
            ],
            [
                'no' => 8,
                'part' => 2,
                'title' => 'How did your suppliers and contractors perform?',
                'badges' => ['All standards'],
                'bring' => [
                    ['Supplier reviews: quality, price, delivery and service.', []],
                    ['Any supplier you stopped using, or need to watch.', []],
                    ['Contractors who work on your site: did they follow your safety rules?', ['H&S']],
                    ['Waste carriers and other environmental services: are their licences in date?', ['Environment']],
                ],
                'where' => [
                    ['Suppliers', 'supplier', ''],
                    ['Supplier Reviews', 'supplier_review', ''],
                ],
                'eg' => '20 suppliers reviewed: 18 approved, 2 on watch for late delivery. The cleaning contractor followed the site rules. Waste carrier licence checked, valid until 2027.',
                'ph' => 'Write your answer here. If this question does not apply to you, write N/A.',
            ],
            [
                'no' => 9,
                'part' => 2,
                'title' => 'Are you meeting the laws and other rules that apply to you?',
                'badges' => ['Environment', 'H&S'],
                'bring' => [
                    ['Your list of environmental and safety laws, checked in the last 12 months.', []],
                    ['Permits and licences are in date.', []],
                    ['Legal checks are done, for example fire safety, electrical testing and waste records.', []],
                    ['Chemicals are stored and recorded as required.', []],
                    ['If you hold ISO 9001 only, write N/A.', []],
                ],
                'where' => [
                    ['Requirements Due', 'requirements_aspect', ''],
                    ['Chemical Control (COSHH)', 'chemical_control', ''],
                    ['your list of laws', null, '(attach it)'],
                ],
                'eg' => 'List of laws checked Jul 2026, no gaps. Trade licence and waste permit in date. Fire alarm test and electrical testing done. Chemical safety sheets up to date.',
                'ph' => 'Write your answer here. If this question does not apply to you, write N/A.',
            ],
            [
                'no' => 10,
                'part' => 2,
                'title' => 'Have the actions on your risks worked?',
                'badges' => ['All standards'],
                'bring' => [
                    ['Business risks and opportunities: did the planned actions work?', ['Quality']],
                    ['Your main environmental impacts: are the controls working?', ['Environment']],
                    ['Hazards: are the controls working, and were risk assessments updated after incidents?', ['H&S']],
                    ['Any new risks or opportunities to add.', []],
                ],
                'where' => [
                    ['Risk Assessments', 'risk_assessment', ''],
                    ['Environmental Impacts', 'environmental_impacts', ''],
                    ['Hazard Register', 'hazards', ''],
                    ['Accident Risk Assessments', 'accident_risk', ''],
                ],
                'eg' => 'A second steel supplier was added, so no shortages this year. Noise controls are working. Hazard Register updated after the ladder incident in June.',
                'ph' => 'Write your answer here. If this question does not apply to you, write N/A.',
            ],
            [
                'no' => 11,
                'part' => 2,
                'title' => 'Do you have the people, skills, equipment and money you need?',
                'badges' => ['All standards'],
                'bring' => [
                    ['Enough people, with the right training for their jobs.', []],
                    ['Training needed in the coming year.', []],
                    ['Equipment and buildings are maintained and fit for the work.', []],
                    ['PPE, first aid and fire equipment are in place and checked.', ['H&S']],
                    ['Anything you need to buy or budget for.', []],
                ],
                'where' => [
                    ['Employees', 'employess', ''],
                    ['Maintenance Records', 'maintance_record', ''],
                    ['Calibration', 'calibration_record', ''],
                    ['Requirements Due', 'requirements_aspect', ''],
                ],
                'eg' => 'One more driver needed by Jan 2027. Forklift training due for 3 staff. The delivery van needs replacing next year, and the budget is agreed.',
                'ph' => 'Write your answer here. If this question does not apply to you, write N/A.',
            ],
            [
                'no' => 12,
                'part' => 2,
                'title' => 'Are your policies, procedures and work instructions still right?',
                'badges' => ['All standards'],
                'bring' => [
                    ['Your policies still fit the business.', ['Quality', 'Environment', 'H&S']],
                    ['Procedures and process flow charts match how the work is really done.', []],
                    ['Work instructions are current, and staff use them.', []],
                    ['Anything to add, change or remove.', []],
                ],
                'where' => [
                    ['Manuals & Policies', 'quality_manual', ''],
                    ['Procedures', 'documented_information', ''],
                    ['Process Flow Charts', 'sale_processes', ''],
                    ['Work Instructions', 'work_instruction', ''],
                ],
                'eg' => 'All three policies still fit. The delivery flow chart needs the new site adding. Two new work instructions needed: forklift charging and waste sorting.',
                'ph' => 'Write your answer here. If this question does not apply to you, write N/A.',
            ],
        ];
    }

    /** the three parts the form is divided into */
    public static function parts()
    {
        return [
            1 => ['label' => 'Part 1', 'title' => 'Looking back: what has happened since the last review'],
            2 => ['label' => 'Part 2', 'title' => 'Checking the system: audits, suppliers, laws, risks, resources and documents'],
            3 => ['label' => 'Part 3', 'title' => 'Decisions and actions: what you agreed, who will do it, and by when'],
        ];
    }

    /**
     * Part 3 section A: the decisions. It is stored as an answer like the
     * questions are, under the key 'A'.
     */
    public static function decisions()
    {
        return [
            'key' => 'A',
            'title' => 'What did you decide?',
            'badges' => ['All standards'],
            'head' => 'What to include',
            'bring' => [
                ['Is the system still right for the business? Say yes, or what needs to change.', []],
                ['Improvements you agreed to make.', []],
                ['Changes to processes, policies, procedures or work instructions.', []],
                ['Resources agreed: people, training, equipment or budget.', []],
                ['What to do about any objective that was not met.', []],
            ],
            'where_text' => 'your answers to questions 1 to 12 above.',
            'eg' => 'The system still fits the business. Agreed: add the Sharjah site to the scope, buy a second forklift, write a waste sorting work instruction, and keep the waste objective for another year.',
            'label' => 'Decisions',
            'ph' => 'Write what was decided.',
        ];
    }

    /**
     * Part 3 section B: next year's objectives. The three boxes are the
     * newquality / newenvironmental / newhealthsafety columns that
     * tbl_mgtreviews already has, so nothing recorded before is lost.
     */
    public static function objectives()
    {
        return [
            'key' => 'B',
            'title' => 'What are your objectives for next year?',
            'badges' => ['Quality', 'Environment', 'H&S'],
            'head' => 'What to include',
            'bring' => [
                ['Each objective needs a target you can measure, an owner and a deadline.', []],
                ['Add each one to the Objectives Tracker, so progress can be updated every three months.', []],
                ['Fill in only the standards you hold.', []],
            ],
            'boxes' => [
                ['field' => 'newquality',       'badge' => 'Quality',     'label' => 'New quality objectives',
                 'ph' => 'e.g. Deliver 97% of orders on time by Dec 2027. Owner: Ali Khan.'],
                ['field' => 'newenvironmental', 'badge' => 'Environment', 'label' => 'New environmental objectives',
                 'ph' => 'e.g. Cut general waste by 15% by Dec 2027. Owner: Priya Nair.'],
                ['field' => 'newhealthsafety',  'badge' => 'H&S',         'label' => 'New health & safety objectives',
                 'ph' => 'e.g. No lost-time accidents in 2027, and 12 toolbox talks. Owner: Omar Saleh.'],
            ],
            'add_to_tracker' => '+ Add to Objectives Tracker',
            'added_note' => 'Will be added to the Objectives Tracker when you save.',
        ];
    }

    /** Part 3 section C: who will do what, and by when */
    public static function actions()
    {
        return [
            'key' => 'C',
            'title' => 'Who will manage what objective, and by when?',
            'badges' => ['All standards'],
            'columns' => ['Objective', 'Who', 'By when', 'Done'],
            'add' => '+ Add action',
            'ph_action' => 'What needs doing',
            'ph_who' => 'Who will do it',
            'note' => 'Open actions show on the Management Reviews list until they are ticked done. Question 1 of the next review checks them.',
        ];
    }

    /** Part 3 section D: the minutes, slides, photos or video */
    public static function files()
    {
        return [
            'key' => 'D',
            'title' => 'Meeting files',
            'badges' => ['All standards'],
            'label' => 'Minutes, slides, photos or video',
            'attach' => 'Attach files',
            'hint' => 'You can add several files: PDF, JPEG, TXT, DOCX, PNG or MP4',
            'accept' => '.pdf,.jpg,.jpeg,.txt,.doc,.docx,.png,.mp4',
        ];
    }

    /** the wording used on every question, in one place */
    public static function labels()
    {
        return [
            // the note above the form. The standards are chips, as the client
            // drew them, so the three words are kept apart from the sentence.
            'intro_lead' => 'One review for all your standards.',
            'intro_a' => 'Answer each question in plain words. Lines marked',
            'intro_or' => 'or',
            'intro_b' => 'only apply if you hold that standard. If a question does not apply to you, write N/A.',
            'before' => 'Before the meeting:',
            'before_a' => 'most answers are already on MyISOOnline. Open the pages under',
            'before_where' => 'Where to look',
            'before_b' => 'and bring the figures with you.',
            'bring_head' => 'What to bring',
            'eg_head' => 'A good answer looks like',
            'where_head' => 'Where to look:',
            'answer_head' => 'Answers and evidence',
            'attach' => 'Attach file',
            'attach_hint' => 'PDF, JPEG, TXT, DOCX or PNG',
            'accept' => '.pdf,.jpg,.jpeg,.txt,.doc,.docx,.png',
            'reviewdate' => 'Review date',
            'chairedby' => 'Chaired by',
            'chairedby_ph' => 'e.g. Sarah Ahmed',
            'chairedby_hint' => 'The person who leads the meeting and signs off the decisions.',
            'attendees' => 'Attendees',
            'attendees_ph' => 'Names and roles, e.g. Ali Khan (operations), Priya Nair (office)',
            'nextdue' => 'Next review due',
            'nextdue_hint' => 'Added to Requirements Due, so a reminder shows on the Dashboard.',
            // the list page
            "col_date" => "Date",
            "col_chairedby" => "Chaired by",
            "col_open" => "Open actions",
            "col_nextdue" => "Next review due",
            "col_actions" => "Actions",
            "chip_open" => ":n open",
            "chip_done" => "All :n done",
            "empty" => "No management reviews recorded yet.",
            "banner_one" => "1 action from the review of :date is still open.",
            "banner_many" => ":n actions from the review of :date are still open.",
            "banner_next" => "Next review due :date.",
            "showing" => "Showing",
            "of" => "of",
            "view" => "View",
            "edit" => "Edit",
            "delete" => "Delete",
            "remove" => "Remove",
            "details_title" => "Management Review Details",
            "add_review" => "Add Management Review",
            "page_title" => "Management Reviews",
            "search_ph" => "Search reviews…",
            "review_of" => "Review from :date",
            "close" => "Close",
            "confirm_title" => "Delete <span id=\"amConfirmType\">Item</span>?",
            "confirm_body" => "You are about to permanently delete <strong id=\"amConfirmLabel\">this item</strong>. This action cannot be undone.",
            "confirm_yes" => "Yes, delete",

            'requirement_title' => 'Management Review',
            'save' => 'Save Review',
            'update' => 'Update Review',
            'cancel' => 'Cancel',
        ];
    }

    /** the chip colour for each standard, the same ones the QMS Audit uses */
    public static function badgeChips()
    {
        return [
            'All standards' => 'neutral',
            'Quality'       => 'info',
            'Environment'   => 'success',
            'H&S'           => 'danger',
        ];
    }
}
