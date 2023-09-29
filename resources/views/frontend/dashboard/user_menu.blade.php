<div class="service-side-bar">
    <div class="services-bar-widget">
        <h3 class="title">User Sidebar</h3>
        @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
        @endphp
        <div class="side-bar-categories">
            <img src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                class="rounded mx-auto d-block" alt="Image" style="width:100px; height:100px;">

            <center>
                <b>{{ $profileData->name }}</b>
                <br>
                <b>{{ $profileData->email }}</b>
            </center>


            <br>
            {{-- <p>{{ $profileData->name }}</p>
            <p>{{ $profileData->email }}</p> --}}
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}">User Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('user.profile') }}">User Profile </a>
                </li>
                <li>
                    <a href="#">Change Password</a>
                </li>
                <li>
                    <a href="#">Booking Details </a>
                </li>
                <li>
                    <a href="#">Logout </a>
                </li>
            </ul>
        </div>
    </div>
</div>