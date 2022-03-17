@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>P1 - Documented Information</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
				<div class="procedure_div">
					<h4>1. Purpose and scope</h4>
					<p>This procedure sets out how documents are created, authorised, distributed, revised and updated.<br>
                    This procedure ensures that all documents and records which form part of the management system are stored securely and have a minimum stipulated retention time. In some cases the retention time is required by statute. The procedure also sets out the back-up routine for documents held on computer.</p>
                    <h4 class="m-t-20">2. Responsibility</h4>
                    <p>The quality representative is responsible for the administration of document control procedures and obtaining the correct authorisations. Maintaining document identity and issue status, controlling distribution, updating, and keeping archive files is the responsibility of the online system.<br>
                     {{Auth::user()->director}}  plays the major part in the retention of records outside this system, but other members of staff are designated to hold certain records as detailed in this procedure.</p>
                    <h4 class="m-t-20">3. Controlled documents</h4>
                    <h5 class="m-t-20">3.1 Definition</h5>
                    <p>Controlled documents are documents which must be authorised before issue, are given an issue and/or revision status and are issued to this system that automatically controls revisions of the document.</p>
                    <p>The controlled documents are:</p>
                    <p>Management Manual</p>
                    <p>Operating Procedures</p>
                    <p>Work Instructions</p>
                    <h5 class="m-t-20">3.2 Authorisation</h5>
                    <p>Each issue or revision of a controlled document shall be either be authorised by the appropriate person, or controlled by this online system:</p>
                    <p>Management Manual –  {{Auth::user()->director}} </p>
                    <p>Registers –  {{Auth::user()->director}} </p>
                    <p>Operating Procedures –  {{Auth::user()->director}} </p>
                    <p>Work Instructions –  {{Auth::user()->director}} </p>
                    <p>The authorisation shall be either recorded on the document, or be registered on this system.</p>
                    <h5 class="m-t-20">3.3 Page layout</h5>
                    <p>When on paper external to this system, all documents shall display a page count.</p>
                    <h5 class="m-t-20">3.4 Issue and revision status</h5>
                    <p>All documents controlled externally shall carry a revision status. The Manual and the baseline procedures are automatically controlled by this system and therefore do not need to carry a revision status providing they are viewed online. If these procedures are printed or used outside this system, their issue status or date printed needs to be specified as these documents are considered uncontrolled.</p>
                    <p>Operating Procedures and Work Instructions can carry an issue number or they can be controlled by issue date. When any part of one of these documents is revised, the whole document shall be re-issued.</p>
                    <p>An archive file shall be used to store previous revisions of each externally controlled document. This system shall manage previous revisions and copies are available upon request.</p>
                    <h5 class="m-t-20">3.5 Identification of changes</h5>
                    <p>Changes where considered appropriate, shall be identified in the FAQ section.</p>
                    <h5 class="m-t-20">3.6 Distribution</h5>
                    <p>The organisation may only refer to this system as the master document. In the event of a hard copy being required, this will be uncontrolled. The master copy shall be held on the electronic system.</p>
                    <h5 class="m-t-20">3.7 Archives</h5>
                    <p>When documents are re-issued or revised, a copy of the original document or pages are placed in an archive file and are available if requested.</p>
                    <h5 class="m-t-20">3.8 Local documents held on computer for direct reference</h5>
                    <p>Where documents are held on computer for direct reference there is no need for formal records of issues and distribution. The document shall carry a record showing the date created or last amended.<br>When any such document is altered, users shall be advised by e-mail, that an alteration has been made.<br>If any computer held document is printed for any purpose, the printed copy shall be uncontrolled and shall be destroyed after use.</p>
                    <h5 class="m-t-20">3.9 Uncontrolled documents</h5>
                    <p>If a copy of a controlled document is issued for information only, e.g. to a customer, it shall be marked confidential and uncontrolled.</p>
                    <h4 class="m-t-20">4. Forms</h4>
                    <p>Forms are a direct link to the record database and shall be issue controlled as other documents are.
					Issue status shall be denoted and the date of the current version shall be noted in the index.</p>
					<h4 class="m-t-20">5. Documents of external origin</h4>
					<h5 class="m-t-20">5.1 Master copies</h5>
					<p>The quality representative shall keep the master copy of all reference documents of external origin, e.g. British Standards, copies of legislation, codes of practice.
					</p>
					<h5 class="m-t-20">5.2 Updating standards</h5>
					<p>Updated standards shall be checked every 6 months by visiting the appropriate website.</p>
					<h5 class="m-t-20">5.3 Updating legislation</h5>
					<p>There shall be a means of ensuring that the organisation is kept up-to-date with any changes to legislation, codes of practice, etc., which are relevant.
					 {{Auth::user()->director}}  shall incorporate any changes to existing legislation, or any new relevant legislation, into the Register of Legislation.</p>
					<h5 class="m-t-20">5.4 Obtaining up-to-date documents</h5>
					<p>When a document of external origin is found to have been updated, the Director shall decide whether there is a need to obtain a new copy immediately or not. In either case, the existing copy shall be marked uncontrolled until a new copy is obtained.</p>
					<p>Documents marked uncontrolled shall be used for information only; if the document is required for definitive use, the user shall check that the relevant text is still current; if not, an up-to-date copy shall be obtained.</p>
					<h4 class="m-t-20">6. Obsolete documents</h4>
					<p>When documents are revised, they shall be issued to all locations where they are needed for the efficient functioning of the management system and obsolete documents shall be withdrawn.</p>
					<p>Where obsolete or invalid documents need to be retained for legal or historical reasons, they shall clearly be marked as withdrawn.</p>
					<h4 class="m-t-20">7. Legibility</h4>
					<p>Every person who fills in a form or other record shall ensure that everything, including any initials or signature, is legible.</p>
					<h4 class="m-t-20">8. Retention time</h4>
					<p>Retention times and computer back up procedures are defined in the control of records procedure.<br>
                    The documents that are to be retained, other than located electronically, their location and the retention times shall be recorded. General records held within this system have an indefinite retention time.<br>
                    The three year retention period for documents which demonstrate the performance of the management system is in accord with the three year review cycle set by UKAS.<br>
                    Remember that when statutory documents have an extended period of validity, the retention time starts when the document expires.<br>
                    All records held outside this electronic system are to be identified, indexed within this system and stored securely so that they are protected and secure. Records may be disposed of on the authority of the holder when the retention time has expired.</p>
                    <h4 class="m-t-20">9. Computer records</h4>
                    <p>Computer records held outside this system shall be backed up securely off-site. Records held within this system are backed up separately.</p>
				</div>
			</div>
		</div>
	</section>

	<!--End::Section-->
</div>
@endsection
<!-- end:: Content -->