@props(['user'])

<!-- Action Buttons -->
<div class="user-profile-actions-container">
    @if($user->deleted_at != null && $user->moreDetail->is_banned)
        <button wire:click="unban" type="button" class="ban-button cancel"><div>UNBAN</div><img src="{{asset('build/assets/img/active_icon.png')}}" alt="ban icon"></button>
    @elseif($user->deleted_at != null)
        <p class="deleted-word">Deleted</p>
    @else
        <button wire:click="ban" type="button" class="ban-button"><div class="ban-word">BAN</div><img src="{{asset('build/assets/img/ban_icon.png')}}" alt="ban icon"></button>
    @endif
</div>