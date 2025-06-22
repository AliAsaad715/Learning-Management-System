@use('Carbon\Carbon')
@use('App\Enums\TypeEnum')

<div class="users-container">
        <div class="users-header">
            <h1 class="users-title">{{ucfirst($type->value)}}s</h1>
        </div>

        <div class="user-filter-tabs">
            <div @class(['filter-tab', 'active' => $filter === 'all']) wire:click="changeFilter('all')">All Users ({{ $counts['all'] ?? 0 }})</div>
            <div @class(['filter-tab', 'active' => $filter === 'active']) wire:click="changeFilter('active')">Active ({{ $counts['active'] ?? 0 }})</div>
            <div @class(['filter-tab', 'active' => $filter === 'banned']) wire:click="changeFilter('banned')">Banned ({{ $counts['banned'] ?? 0 }})</div>
            <div @class(['filter-tab', 'active' => $filter === 'deleted']) wire:click="changeFilter('deleted')">Deleted ({{ $counts['deleted'] ?? 0 }})</div>
        </div>

        <table class="users-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Job Title</th>
                    <th>Country</th>
                    <th>Join Date</th>
                    <th>Is Active</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @if($type == TypeEnum::USER)
                        <tr onclick="window.location='{{ route('users.show_user', ['user_id' => $user->id]) }}'">
                    @else
                        <tr onclick="window.location='{{ route('users.show_teacher', ['teacher_id' => $user->id]) }}'">
                    @endif
                    <td>
                        <div class="user-name">
                            @if($user->profile_image_url)
                                <img src="{{ asset("build/assets/img/profiles/$user->profile_image_url") }}" alt="Profile Image" class="user-avatar">
                            @else
                                <img src="{{ asset('build/assets/img/anonymous_icon.png') }}" alt="Profile Image" class="user-avatar">
                            @endif
                            {{ $user->first_name }} {{ $user->last_name }}
                        </div>
                    </td>
                    <td>
                        <span class="user-role role-{{ $user->role }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td>{{ $user->moreDetail->jobTitle->title ?? 'N/A' }}</td>
                    <td>{{ $user->moreDetail->country->name }}</td>
                    <td>{{Carbon::parse($user->join_date)->format('M d, Y')}}</td>
                    <td>
                    <img 
                        @if($user->deleted_at != null && $user->moreDetail->is_banned) 
                            src="{{ asset('build/assets/img/ban_icon_red.png') }}" 
                            alt="banned user"
                        @elseif($user->deleted_at != null && !$user->moreDetail->is_banned)
                            src="{{ asset('build/assets/img/delete_icon.png') }}" 
                            alt="deleted user"    
                        @else
                            src="{{ asset('build/assets/img/active_icon.png') }}" 
                            alt="active user"
                        @endif
                    >
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>