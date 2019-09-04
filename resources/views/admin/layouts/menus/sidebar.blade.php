<div class="py-4 container-fluid">
            <div class="sidebar float-left" id="sidebar">
                <div class="text-center">
                    <img src="https://via.placeholder.com/100" alt="" class="border-radius">
                    <h5>{{Auth::user()->name}}</h5>
                </div>
                <div class="items-container">
                    <a href="{{route('home')}}">
                    <h6><i class="feather icon-home"></i><span class="padding-left">Dashboard </span></h6>
                    </a>

                    <a href="{{route('admin.users')}}">
                    <h6><i class="feather icon-users"></i><span class="padding-left">Users</span></h6>
                    </a>
                    <a href="{{route('admin.prospects')}}">
                      <i class="feather icon-users"></i><span class="padding-left">Prospects</span>
                    </a>
                </div>
            </div>
        </div>
