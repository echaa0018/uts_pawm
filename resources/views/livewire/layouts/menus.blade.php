<div>
    {{-- Menu --}}
    <x-menu class="text-xs space-y-0 p-1" active-bg-color="font-black" activate-by-route>
        <x-menu-item title="Home" icon="o-home" link="{{ route('home') }}" />
        
        {{-- Virtual Lab Section --}}
        <x-menu-sub title="Virtual Lab" icon="o-beaker">
            <x-menu-item title="Physics Lab" icon="o-bolt" link="{{ route('virtual-lab.physics') }}" />
            <x-menu-item title="Math Lab" icon="o-calculator" link="{{ route('virtual-lab.math') }}" />
            <x-menu-item title="Chemistry Lab" icon="o-beaker" link="{{ route('virtual-lab.chemistry') }}" />
        </x-menu-sub>
        
        {{-- Administrator Section --}}
        <x-menu-sub title="Administrator" icon="o-cog-6-tooth" link="#">
            <x-menu-item title="Users" icon="o-users" link="{{ route('user.index') }}" />
            <x-menu-item title="Roles" icon="o-user-group" link="{{ route('role.index') }}" />
        </x-menu-sub>
    </x-menu>
</div>