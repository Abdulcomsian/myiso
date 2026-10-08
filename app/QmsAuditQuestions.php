<?php

namespace App;

class QmsAuditQuestions
{
    /**
     * The QMS Audit: 17 plain-language questions covering ISO 9001, 14001 and
     * 45001, as the client wrote them.
     *
     * Each question carries:
     *   no       the number shown in the circle
     *   title    the question itself
     *   badges   which standards it covers - All standards / Quality / Environment / H&S
     *   check    the "what to check" lines; each is [text, tags] and a tag marks a
     *            line that only applies under that standard
     *   where    "where to look"; each is [label, route, suffix] and a null route
     *            means it is not a page on this site, so it is written as plain text
     *   yes/no   the wording for ticking each way
     *   na       the wording for N/A, or null when the question has no N/A
     *   eg       the example shown in the evidence box
     *   field    the column that holds the answer, and the one that holds the note
     */
    public static function all()
    {
        return [
            [
                'no' => 1,
                'title' => 'Are your business context, interested parties and scope up to date?',
                'badges' => ['All standards'],
                'check' => [
                    ['The list of things inside and outside your business that could affect it (staff, competitors, laws, economy) was reviewed in the last 12 months.', []],
                    ['The Interested Parties list is complete and reviewed.', []],
                    ['The scope still matches what you do, and any exclusions are still valid.', []],
                    ['The process flow charts match how work really happens.', []],
                ],
                'where' => [
                    ['Quality Manual', 'quality_manual', '(4.1, 4.3)'],
                    ['Interested Parties', 'interesting_parties', ''],
                    ['Process Flow Charts', 'sale_processes', ''],
                ],
                'tick_yes' => 'All four lines are in place and up to date.',
                'tick_no' => 'Any line is missing or out of date. Say which.',
                'tick_na' => null,
                'eg' => 'e.g. Issues list and Interested Parties reviewed Mar 2026; scope and flow charts still match',
            ],
            [
                'no' => 2,
                'title' => 'Is top management involved, and are your policies and roles clear?',
                'badges' => ['All standards'],
                'check' => [
                    ['The Director chaired the last Management Review and provided the time, money or people needed.', []],
                    ['The Quality Policy is current, on display, and staff know what it is about.', ['Quality']],
                    ['The Environmental Policy is current, on display, and staff know what it is about.', ['Environment']],
                    ['The Health & Safety Policy is current, on display, and staff know their duties.', ['H&S']],
                    ['The organogram is up to date and names who looks after the system.', []],
                ],
                'where' => [
                    ['Management Reviews', 'add_management_review', ''],
                    ['Quality Policy', 'quality_policy', ''],
                    ['Environmental Policy', 'environment_policy', ''],
                    ['Health & Safety Policy', 'health_policy', ''],
                    ['Management Organogram', 'management_organogram', ''],
                ],
                'tick_yes' => 'Every line that applies to you is in place.',
                'tick_no' => 'Any line is missing. Say which.',
                'tick_na' => null,
                'eg' => 'e.g. Director chaired review Mar 2026; all 3 policies signed Jan 2026 and displayed',
            ],
            [
                'no' => 3,
                'title' => 'Have you identified your risks, and are they under control?',
                'badges' => ['All standards'],
                'check' => [
                    ['Your main business risks and opportunities are written down, each with an action.', []],
                    ['The Environmental Aspects & Impacts Register is complete and reviewed.', ['Environment']],
                    ['The Hazard Register is complete and updated after any incident.', ['H&S']],
                    ['You have a list of the environmental and safety laws you must follow, reviewed in the last 12 months.', ['Environment', 'H&S']],
                ],
                'where' => [
                    ['Risk Assessments', 'risk_assessment', ''],
                    ['Environmental Aspects & Impacts Register', 'environmental_impacts', ''],
                    ['Hazard Register', 'hazards', ''],
                    ['your legal register (attach it)', null, ''],
                ],
                'tick_yes' => 'Every line that applies to you is in place.',
                'tick_no' => 'Any line is missing or out of date. Say which.',
                'tick_na' => null,
                'eg' => 'e.g. Risks reviewed Mar 2026; Hazard Register updated Sep 2026; legal list attached',
            ],
            [
                'no' => 4,
                'title' => 'Do you have measurable objectives, and were any big changes planned?',
                'badges' => ['All standards'],
                'check' => [
                    ['Quality objectives have a target, an owner and a deadline, and progress is tracked.', ['Quality']],
                    ['Environmental objectives (e.g. reduce waste by 15%) are set and tracked.', ['Environment']],
                    ['Health and safety objectives (e.g. zero lost-time accidents) are set and tracked.', ['H&S']],
                    ['Any big changes this year (new service, equipment, software) were planned and approved first.', []],
                ],
                'where' => [
                    ['Objectives Tracker', 'objectives_tracker', '(progress during the year)'],
                    ['Management Reviews', 'add_management_review', '(where objectives are agreed)'],
                ],
                'tick_yes' => 'Every line that applies to you is in place. No big changes this year is fine; say so.',
                'tick_no' => 'Objectives are missing or not tracked, or a change was not planned.',
                'tick_na' => null,
                'eg' => 'e.g. 3 objectives per standard, all tracked; new CRM planned and approved',
            ],
            [
                'no' => 5,
                'title' => 'Do you have the resources and equipment you need?',
                'badges' => ['All standards'],
                'check' => [
                    ['No maintenance is overdue.', []],
                    ['All measuring equipment is calibrated and in date.', []],
                    ['Safety equipment is in place and checked: PPE, first aid kits, fire extinguishers.', ['H&S']],
                    ['The team is not short of the people, tools or space they need.', []],
                ],
                'where' => [
                    ['Maintenance Records', 'maintance_record', ''],
                    ['Calibration', 'calibration_record', ''],
                    ['Requirements Due', 'requirements_aspect', ''],
                ],
                'tick_yes' => 'Every line that applies to you is in place.',
                'tick_no' => 'Anything is overdue or clearly short. Say which.',
                'tick_na' => null,
                'eg' => 'e.g. 0 overdue items on Dashboard; extinguishers serviced Apr 2026',
            ],
            [
                'no' => 6,
                'title' => 'Are your people trained, aware and kept informed?',
                'badges' => ['All standards'],
                'check' => [
                    ['Pick 2 or 3 staff. Their training records are complete for their job.', []],
                    ['Ask them: "What do you do if something goes wrong?" They know the answer and know the policies exist.', []],
                    ['Information is shared regularly, e.g. team meetings or a noticeboard, and there is a record of it.', []],
                    ['Workers are asked for their views on safety, e.g. toolbox talks or safety meetings.', ['H&S']],
                ],
                'where' => [
                    ['Employees', 'employess', ''],
                    ['QP4 – Competency Process', 'competency_process', ''],
                    ['meeting notes', null, ''],
                ],
                'tick_yes' => 'Every line that applies to you is in place.',
                'tick_no' => 'Training is missing, staff are unaware, or nothing is shared. Say which.',
                'tick_na' => null,
                'eg' => 'e.g. 3 staff sampled, training complete, monthly toolbox talks recorded',
            ],
            [
                'no' => 7,
                'title' => 'Are your documents current and your records complete?',
                'badges' => ['All standards'],
                'check' => [
                    ['Are the procedures the latest version? Open a few to check.', []],
                    ['Records are filled in properly and kept on MyISOOnline.', []],
                ],
                'where' => [
                    ['P1 – Documented Information', 'documented_information', ''],
                ],
                'tick_yes' => 'Documents are current and records complete.',
                'tick_no' => 'Old versions are in use, or records are missing.',
                'tick_na' => null,
                'eg' => 'e.g. 6 procedures sampled, all current',
            ],
            [
                'no' => 8,
                'title' => 'Is work planned and controlled before and during each job?',
                'badges' => ['All standards'],
                'check' => [
                    ['Pick a recent job. It was planned before work started.', []],
                    ['Walk around: waste is sorted, chemicals are stored safely, energy is not wasted.', ['Environment']],
                    ['Risky tasks have an Accident Risk Assessment, and the controls are being followed.', ['H&S']],
                    ['Contractors were checked (insurance, training, risk assessment) before they started.', ['H&S']],
                ],
                'where' => [
                    ['QP3 – Servicing of a Contract', 'servicing_contract', ''],
                    ['Environmental Aspects & Impacts Register', 'environmental_impacts', ''],
                    ['Chemical Control (COSHH)', 'chemical_control', ''],
                    ['Accident Risk Assessments', 'accident_risk', ''],
                ],
                'tick_yes' => 'Every line that applies to you is in place.',
                'tick_no' => 'Any line is not happening. Say which.',
                'tick_na' => null,
                'eg' => 'e.g. Job #1045 planned; walk-round OK; electrician checked Aug 2026',
            ],
            [
                'no' => 9,
                'title' => 'Do you confirm what the customer wants before accepting an order?',
                'badges' => ['Quality'],
                'check' => [
                    ['Pick a recent order. The quote, the order and any changes were confirmed with the customer.', []],
                    ['The job was reviewed before it was accepted.', []],
                ],
                'where' => [
                    ['QP1 – Sales Process', 'sale_processes', ''],
                    ['Risk Assessments', 'risk_assessment', ''],
                ],
                'tick_yes' => 'Requirements were confirmed before accepting.',
                'tick_no' => 'Orders are accepted without checking.',
                'tick_na' => 'Only if you are not certified to ISO 9001.',
                'eg' => 'e.g. Order #1045: quote, purchase order and risk assessment on file',
            ],
            [
                'no' => 10,
                'title' => 'Are emergency plans in place and tested?',
                'badges' => ['Environment', 'H&S'],
                'check' => [
                    ['There are written plans for emergencies such as fire, a chemical spill or a serious injury.', []],
                    ['Staff know what to do and where the assembly point is.', []],
                    ['A drill was done in the last 12 months, and lessons were written down.', []],
                ],
                'where' => [
                    ['emergency plans, drill records', null, ''],
                    ['Requirements Due', 'requirements_aspect', ''],
                    ['Work Instructions', 'work_instruction', ''],
                ],
                'tick_yes' => 'Plans exist and were tested in the last 12 months.',
                'tick_no' => 'No plans, or never tested.',
                'tick_na' => 'Only if you hold neither ISO 14001 nor ISO 45001.',
                'eg' => 'e.g. Fire drill 14 May 2026, building cleared in 3 minutes',
            ],
            [
                'no' => 11,
                'title' => 'Do you design your own products or services?',
                'badges' => ['Quality'],
                'check' => [
                    ['If you design: design work is planned, reviewed and checked before release.', []],
                    ['If you do not design: the exclusion is written in the Quality Manual (4.3.3). Most small businesses do not design.', []],
                ],
                'where' => [
                    ['Quality Manual', 'quality_manual', '(4.3.3)'],
                ],
                'tick_yes' => 'You design, and it is controlled.',
                'tick_no' => 'You design, but it is not controlled.',
                'tick_na' => 'You do not design and it is excluded, or you are not certified to ISO 9001.',
                'eg' => 'e.g. Design excluded, Quality Manual 4.3.3',
            ],
            [
                'no' => 12,
                'title' => 'Are your suppliers approved and reviewed?',
                'badges' => ['Quality'],
                'check' => [
                    ['The suppliers you use are on the Suppliers list.', []],
                    ['Their performance was reviewed, and any supplier problems were recorded.', []],
                ],
                'where' => [
                    ['Suppliers', 'supplier', ''],
                    ['Non-Conformities', 'non_confromities', ''],
                ],
                'tick_yes' => 'Suppliers are approved and reviewed.',
                'tick_no' => 'Unapproved suppliers are used, or none are reviewed.',
                'tick_na' => 'Only if you are not certified to ISO 9001.',
                'eg' => 'e.g. 12 suppliers listed, all reviewed in 2026',
            ],
            [
                'no' => 13,
                'title' => 'Is work done correctly, checked before delivery, and faulty work stopped?',
                'badges' => ['Quality'],
                'check' => [
                    ['Watch a task or check a recent job. The Work Instructions were followed.', []],
                    ['A final check was recorded before the work went to the customer.', []],
                    ['Faulty work is recorded in Non-Conformities and not sent to the customer.', []],
                ],
                'where' => [
                    ['Work Instructions', 'work_instruction', ''],
                    ['Process Audits', 'process_audit', ''],
                    ['Non-Conformities', 'non_confromities', ''],
                ],
                'tick_yes' => 'All three lines are in place.',
                'tick_no' => 'Any line is not happening. Say which.',
                'tick_na' => 'Only if you are not certified to ISO 9001.',
                'eg' => 'e.g. WI-03 followed; job #1045 signed off; 2 NCs recorded',
            ],
            [
                'no' => 14,
                'title' => 'Are you measuring performance and checking you follow the law?',
                'badges' => ['All standards'],
                'check' => [
                    ['Key figures are measured and reviewed, e.g. complaints, late deliveries, waste, accidents.', []],
                    ['Customer feedback was collected this year and acted on.', ['Quality']],
                    ['Every law on your legal list was checked this year, with a note of how you comply.', ['Environment', 'H&S']],
                ],
                'where' => [
                    ['Management Reviews', 'add_management_review', ''],
                    ['Dashboard', 'home', ''],
                    ['Customer Review', 'customer_review', ''],
                    ['your legal register', null, ''],
                ],
                'tick_yes' => 'Every line that applies to you is in place.',
                'tick_no' => 'Any line is missing, or you found you are not complying. Say which.',
                'tick_na' => null,
                'eg' => 'e.g. KPIs reviewed Mar 2026; 10 customer reviews; 14 laws checked Aug 2026',
            ],
            [
                'no' => 15,
                'title' => 'Were your internal audits done as planned?',
                'badges' => ['All standards'],
                'check' => [
                    ['Every process was audited as planned, covering each standard you hold.', []],
                    ['Nobody audited their own work.', []],
                    ['Findings were followed up and closed.', []],
                ],
                'where' => [
                    ['Process Audits', 'process_audit', ''],
                    ['P5 – Audits', 'auidt', ''],
                ],
                'tick_yes' => 'All three lines are in place.',
                'tick_no' => 'Audits were missed, or findings not followed up.',
                'tick_na' => null,
                'eg' => 'e.g. 9 process audits in 2026, all findings closed',
            ],
            [
                'no' => 16,
                'title' => 'Was a Management Review held in the last 12 months?',
                'badges' => ['All standards'],
                'check' => [
                    ['A review was held within the last 12 months, chaired by the Director.', []],
                    ['It covered the full P3 agenda, including quality, environment and safety results for each standard you hold.', []],
                    ['Actions were recorded with an owner and a date.', []],
                ],
                'where' => [
                    ['Management Reviews', 'add_management_review', ''],
                    ['P3 – Management Review', 'management_review', ''],
                ],
                'tick_yes' => 'All three lines are in place.',
                'tick_no' => 'No review in 12 months, or parts were missed.',
                'tick_na' => null,
                'eg' => 'e.g. Review held 21 Mar 2026, minutes and 6 actions on file',
            ],
            [
                'no' => 17,
                'title' => 'Are problems fixed properly, and is your system getting better?',
                'badges' => ['All standards'],
                'check' => [
                    ['Pick 2 non-conformities. The root cause was found, it was fixed, and someone checked later that the fix worked.', []],
                    ['Incidents and near-misses are reported and investigated.', ['H&S']],
                    ['At least one real improvement was made this year.', []],
                    ['There are fewer repeat problems than last year.', []],
                ],
                'where' => [
                    ['Non-Conformities', 'non_confromities', ''],
                    ['P2 – Corrective Actions', 'corrective_action', ''],
                    ['Incident Report Form', 'incidents', ''],
                    ['Management Reviews', 'add_management_review', ''],
                ],
                'tick_yes' => 'Every line that applies to you is in place.',
                'tick_no' => 'Root causes not found, incidents not investigated, or the same problems keep happening. Say which.',
                'tick_na' => null,
                'eg' => 'e.g. NC-012 / NC-015 closed and checked; 2 near-misses investigated; complaints down 5 to 2',
            ],
        ];
    }

    /** the colour each badge wears */
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
