@props(['size' => 'full'])
<x-trmnl::view size="{{$size}}">
    <x-trmnl::layout class="layout--col gap--space-between">

        <div class="grid" style="gap: 8px;">

            <!-- HEADER -->
            <div class="row row--center col--span-3 col--end">
                <div style="text-align:left; width:100%; padding-left:40px; padding-top:22px; ">
                    <span class="value @if($size == 'full' || $size == 'half_horizontal') value--large @else value--medium @endif">
                        PVE
                    </span>
                </div>
            </div>

            <!-- CPU -->
            <div class="col col--span-3 col--center">
                <div class="item" style="padding-left:6px;">
                    <div class="content justify-start">
                        <span class="value @if($size == 'full') value--xlarge @else value--medium @endif"
                              data-fit-value="true">{{Arr::get($data,'cpu','N/A')}}%</span>
                        <span class="label" style="margin-left:4px;">CPU Usage</span>
                    </div>
                    <div class="h-2 bg-gray-200 rounded mt-1">
                        <div class="h-2 bg-black rounded"
                             style="width: {{Arr::get($data,'cpu',0)}}%"></div>
                    </div>
                </div>
            </div>

            <!-- RAM -->
            <div class="col col--span-3 col--center">
                <div class="item" style="padding-left:6px;">
                    <div class="content justify-start">
                        <span class="value @if($size == 'full') value--xlarge @else value--medium @endif"
                              data-fit-value="true">{{Arr::get($data,'ram','N/A')}}%</span>
                        <span class="label" style="margin-left:4px;">RAM Usage</span>
                    </div>
                    <div class="h-2 bg-gray-200 rounded mt-1">
                        <div class="h-2 bg-black rounded"
                             style="width: {{Arr::get($data,'ram',0)}}%"></div>
                    </div>
                </div>
            </div>

            <!-- DISK -->
            <div class="col col--span-3 col--center">
                <div class="item" style="padding-left:6px;">
                    <div class="content justify-start">
                        <span class="value @if($size == 'full') value--xlarge @else value--medium @endif"
                              data-fit-value="true">{{Arr::get($data,'disk','N/A')}}%</span>
                        <span class="label" style="margin-left:4px;">Disk Usage</span>
                    </div>
                    <div class="h-2 bg-gray-200 rounded mt-1">
                        <div class="h-2 bg-black rounded"
                             style="width: {{Arr::get($data,'disk',0)}}%"></div>
                    </div>
                </div>
            </div>

        </div>

    </x-trmnl::layout>

    <!-- FOOTER -->
    <x-trmnl::title-bar title="Uptime: {{Arr::get($data,'uptime_days','N/A')}} d"
                        instance="updated: {{ now()->format('H:i:s') }}"/>
</x-trmnl::view>
