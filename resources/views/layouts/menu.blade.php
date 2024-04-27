<x-menu-wrapper>
    {{-- <x-menu-item active="grant.*" route="grant.*" parent="Dashboard Grant" type="sub">
        <x-menu-item active="grant.overview" route="grant.overview">Research Overview</x-menu-item>
        <x-menu-item active="grant.faculty-year" route="grant.faculty-year">Faculty Achievement - Year</x-menu-item>
        <x-menu-item active="grant.faculty-active" route="grant.faculty-active">Faculty Achievement - Active Grant</x-menu-item>
        <x-menu-item active="grant.faculty-all" route="grant.faculty-all">Faculty Achievement - All Grant</x-menu-item>
        <x-menu-item active="grant.proposal.*" route="grant.proposal">Proposal in Year</x-menu-item>
        <x-menu-item active="grant.myra.*" route="grant.myra">Research MyRA</x-menu-item>
    </x-menu-item> --}}
    <x-menu-item active="myra.*" route="" icon="clipboard" parent="Insights" type="sub">
        @if(user()->role == 'super_admin')<x-menu-item active="myra.self-assessment.*" route="myra.self-assessment.section-a">UTM eMyRA</x-menu-item>@endif
        <x-menu-item active="myra.index" route="myra.index">Overview</x-menu-item>
        
        <x-menu-item active="myra.info.*" route="myra.info.staff">General Info</x-menu-item>
        <x-menu-item active="myra.section-b" route="myra.section-b" customTabVal="INVESTIGATOR">Section B: Quantity and Quality of Researchers</x-menu-item>
        <x-menu-item active="myra.section-c" route="myra.section-c" customTabVal="PUBLICATION-ALL">Section C: Quantity and Quality of Research</x-menu-item>
        <x-menu-item active="myra.section-d" route="myra.section-d" customTabVal="ABSORPTION">Section D: Quantity and Quality of Postgraduates</x-menu-item>
        <x-menu-item active="myra.section-e" route="myra.section-e">Section E: Innovation </x-menu-item>
        <x-menu-item active="myra.section-f" route="myra.section-f" customTabVal="UNIVERSITY">Section F: Professional Services and Gifts </x-menu-item>
        <x-menu-item active="myra.section-g" route="myra.section-g" customTabVal="STAFFOVERALL">Section G: Networking and Linkages</x-menu-item>
        <x-menu-item active="myra.section-h" route="myra.section-h">Section H: Support Facilities</x-menu-item>
    </x-menu-item>
    @if(user()->role == 'super_admin')
    <x-menu-item active="" rawUrl=true route="https://devkai.utm.my/Home/Dashboard" icon="globe">KAI</x-menu-item>
    <x-menu-item active="research.*" route="" icon="book" parent="UTM Research" type="sub">
        <x-menu-item active="grant.overview" route="grant.overview">Research Overview</x-menu-item>
        {{-- <x-menu-item active="grant.faculty-year" route="grant.faculty-year">Faculty Achievement - Year, Active, All</x-menu-item> --}}
        <x-menu-item active="research.management.*" route="research.management.*" parent="Project Management Division" type="sub">
            <x-menu-item active="research.management.proposal" route="research.management.proposal">Proposal Management</x-menu-item>
            <x-menu-item active="research.management.grant" route="research.management.grant">Grant Management</x-menu-item>
            <x-menu-item active="research.management.activity" route="research.management.activity">Activity Management</x-menu-item>
            <x-menu-item active="research.management.raro-appointment" route="research.management.raro-appointment">RARO Appointment Management</x-menu-item>
            <x-menu-item active="research.management.grasra-appointment" route="research.management.grasra-appointment">GRA SRA Appointment Management</x-menu-item>
            <x-menu-item active="research.management.wages-claim" route="research.management.wages-claim">SPB Wages & Claim Management</x-menu-item>
            <x-menu-item active="research.management.rmarm-distribution" route="research.management.rmarm-distribution">RM/ARM Active Grant Distribution</x-menu-item>
            {{-- <x-menu-item active="research.management.action-list" route="research.management.action-list">List of Action</x-menu-item> --}}
        </x-menu-item>
        {{-- <x-menu-item active="" route="" parent="Industrial & International Linkages Unit" type="sub">
            <x-menu-item active="" route="">PI Achievement – Year</x-menu-item>
            <x-menu-item active="" route="">PI Achievement – Grant</x-menu-item>
            <x-menu-item active="" route="">MyRA @ Jun 2021 - No Amount Received</x-menu-item>
            <x-menu-item active="" route="">PI Achievement by Category</x-menu-item>
        </x-menu-item>
        <x-menu-item active="" route="" parent="Research Monitoring" type="sub">
            <x-menu-item active="" route="">Monitoring Overview</x-menu-item>
            <x-menu-item active="" route="">Monitoring - Status & Extension</x-menu-item>
            <x-menu-item active="" route="">Monitoring - Report Progress</x-menu-item>
            <x-menu-item active="" route="">Received-Spend by V-Series</x-menu-item>
        </x-menu-item>
        <x-menu-item active="" route="" parent="RMC UTM KL" type="sub">
            <x-menu-item active="" route="">Front page</x-menu-item>
            <x-menu-item active="" route="">UTM KL Achievement</x-menu-item>
            <x-menu-item active="" route="">Activity</x-menu-item>
            <x-menu-item active="" route="">RMC UTM KL Achievement</x-menu-item>
        </x-menu-item> --}}
    </x-menu-item>
    @endif
    <x-menu-item active="dana-ru.*" route="" icon="hard-drive" parent="Dana RU" type="sub">
        @if(user()->role == 'super_admin')<x-menu-item active="dana-ru.kewangan.agihan-program.index" route="dana-ru.kewangan.agihan-program.index">Dashboard</x-menu-item>@endif
        {{-- @if(user()->role == 'super_admin')<x-menu-item active="dana-ru.kewangan.overall" route="dana-ru.kewangan.overall">Dashboard</x-menu-item>@endif --}}
        @if(user()->role == 'super_admin' || getAccessControl('dru_bca'))<x-menu-item active="dana-ru.cadangan-agihan.*" route="dana-ru.cadangan-agihan.index">Cadangan Agihan</x-menu-item>@endif
        @if(user()->role == 'super_admin' || getAccessControl('dru_pa') || getAccessControl('dru_pa_s'))<x-menu-item active="dana-ru.kewangan.pengesahan-agihan.index" route="dana-ru.kewangan.pengesahan-agihan.index">Pengesahan Agihan</x-menu-item>@endif
        @if(user()->role == 'super_admin')
        <x-menu-item active="dana-ru.kewangan.perbelanjaan.*" route="" parent="Perincian Perbelanjaan" type="sub">
            <x-menu-item active="dana-ru.kewangan.*" route="dana-ru.kewangan.perbelanjaan.program">Program</x-menu-item>
        </x-menu-item>
        @endif
        <x-menu-item active="dana-ru.senarai-agihan.index" route="dana-ru.senarai-agihan.index">Senarai Agihan</x-menu-item>
        @if(user()->role == 'super_admin' || getAccessControl('dru_pa'))
        <x-menu-item active="dana-ru.masterlist.*" route="" parent="Masterlist" type="sub">
            <x-menu-item active="dana-ru.masterlist.allocation" route="dana-ru.masterlist.allocation">Allocation</x-menu-item>
            <x-menu-item active="dana-ru.masterlist.expenses" route="dana-ru.masterlist.expenses">Expenses</x-menu-item>
        </x-menu-item>
        <x-menu-item active="dana-ru.maintenance.*" route="" parent="Maintenance" type="sub">
            <x-menu-item active="dana-ru.maintenance.tabung-induk" route="dana-ru.maintenance.tabung-induk">Tabung Induk</x-menu-item>
            <x-menu-item active="dana-ru.maintenance.project" rawUrl="true" route="{{ route('dana-ru.maintenance.project') }}">Project</x-menu-item>
        </x-menu-item>
        @endif
    </x-menu-item>
    <x-menu-item active="report.*" route="" icon="file-text" parent="Download" type="sub">
        <x-menu-item active="report.myra.index" route="report.myra.index">Masterlist</x-menu-item>
        <x-menu-item active="report.myra.glossary" route="report.myra.glossary">Glossary</x-menu-item>
    </x-menu-item>
    @if(user()->role == 'super_admin')
    <x-menu-item active="masterlist.*" route="" icon="archive" parent="Upload Masterlist" type="sub">
        <x-menu-item active="masterlist.myra.*" route="masterlist.myra.index">Masterlist</x-menu-item>
        <x-menu-item active="masterlist.project-management.*" route="masterlist.project-management.index">Project Management</x-menu-item>
    </x-menu-item>
    @endif
    <x-menu-item active="" route="logout" icon="log-out">Logout</x-menu-item>
</x-menu-wrapper>