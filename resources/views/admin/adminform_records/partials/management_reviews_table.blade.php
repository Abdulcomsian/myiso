{{-- The admin looks after the same reviews the user does, so the list is the
     user's one with the admin's links. --}}
@include('dashboard.form_records.partials.management_reviews_table', [
    'userData'    => $mgtrev,
    'editBase'    => url('/managementCheck/' . $userid),
    'deleteRoute' => route('deletemgtreviewadmin'),
])
