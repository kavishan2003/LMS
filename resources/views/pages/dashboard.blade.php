@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <h1 class="text-2xl font-bold text-gray-800 mb-4">@yield('title')</h1>
    <div class=" rounded-lg gap-3 flex flex-col md:flex-row justify-around items-start">

        {{-- line chart --}}
        <div class="max-w-3xl w-full bg-neutral-primary-soft block border border-default rounded-base shadow-xs p-4 md:p-6">
            <div class="flex justify-between pb-4 mb-4 border-b border-light">
                <div class="flex items-center">
                    <div
                        class="w-12 h-12 bg-neutral-primary-medium border border-default-medium flex items-center justify-center rounded-full me-3">
                        <svg class="w-7 h-7 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="text-2xl font-semibold text-heading">3.4k</h5>
                        <p class="text-sm text-body">Leads generated per week</p>
                    </div>
                </div>
                <div>
                    <span
                        class="inline-flex items-center bg-success-soft border border-success-subtle text-fg-success-strong text-xs font-medium px-1.5 py-0.5 rounded">
                        <svg class="w-4 h-4 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v13m0-13 4 4m-4-4-4 4" />
                        </svg>
                        42.5%
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-2">
                <dl class="flex items-center">
                    <dt class="text-body text-sm font-normal me-1">Money spent:</dt>
                    <dd class="text-heading text-sm font-semibold">$3,232</dd>
                </dl>
                <dl class="flex items-center justify-end">
                    <dt class="text-body text-sm font-normal me-1">Conversion:</dt>
                    <dd class="text-heading text-sm font-semibold">1.2%</dd>
                </dl>
            </div>
            <div id="column-chart"></div>
            <div class="grid grid-cols-1 items-center border-light border-t justify-between">
                <div class="flex justify-between items-center pt-4 md:pt-6">
                    <!-- Button -->
                    <button id="dropdownLastDaysButton" data-dropdown-toggle="LastDaysdropdown"
                        data-dropdown-placement="bottom"
                        class="text-sm font-medium text-body hover:text-heading text-center inline-flex items-center"
                        type="button">
                        Last 7 days
                        <svg class="w-4 h-4 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 9-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="LastDaysdropdown"
                        class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
                        <ul class="p-2 text-sm text-body font-medium" aria-labelledby="dropdownLastDaysButton">
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Yesterday</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Today</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Last
                                    7 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Last
                                    30 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Last
                                    90 days</a>
                            </li>
                        </ul>
                    </div>
                    <a href="#"
                        class="inline-flex items-center text-fg-brand bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-base text-sm px-3 py-2 focus:outline-none">
                        Leads Report
                        <svg class="w-4 h-4 ms-1.5 -me-0.5 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- radial chart --}}
        <div class="max-w-sm w-full bg-neutral-primary-soft block border border-default rounded-base shadow-xs p-4 md:p-6">
            <div class="flex justify-between mb-4 md:mb-6">
                <div class="flex items-center">
                    <div class="flex justify-center items-center">
                        <h5 class="text-xl font-semibold text-heading me-1">Your team's progress</h5>
                        <svg data-popover-target="team-progress-2" data-popover-placement="bottom"
                            class="w-4 h-4 text-body hover:text-heading cursor-pointer ms-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.529 9.988a2.502 2.502 0 1 1 5 .191A2.441 2.441 0 0 1 12 12.582V14m-.01 3.008H12M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <div data-popover id="team-progress-2" role="tooltip"
                            class="absolute z-10 p-3 invisible inline-block text-sm text-body transition-opacity duration-300 bg-neutral-primary-soft border border-default rounded-base shadow-xs opacity-0 w-72">
                            <div>
                                <h3 class="font-semibold text-heading mb-2">Activity growth - Incremental</h3>
                                <p class="mb-4">Report helps navigate cumulative growth of community activities. Ideally,
                                    the
                                    chart should have a growing trend, as stagnating chart signifies a significant decrease
                                    of
                                    community activity.</p>
                                <h3 class="font-semibold text-heading mb-2">Calculation</h3>
                                <p class="mb-4">For each date bucket, the all-time volume of activities is calculated.
                                    This
                                    means that activities in period n contain all activities up to period n, plus the
                                    activities
                                    generated by your community in period.</p>
                                <a href="#" class="flex items-center font-medium text-fg-brand hover:underline">
                                    Read more
                                    <svg class="w-4 h-4 ms-1 rtl:rotate-180" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                    </svg>
                                </a>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-neutral-secondary-medium border border-light-medium p-3 rounded-base">
                <div class="grid grid-cols-3 gap-3 mb-3">
                    <dl
                        class="bg-brand-softer border border-brand-subtle text-fg-brand-strong rounded-base flex flex-col items-center justify-center h-[78px]">
                        <dt
                            class="w-8 h-8 rounded-full bg-brand-soft text-fg-brand-strong text-sm font-medium flex items-center justify-center mb-1">
                            12</dt>
                        <dd class="text-fg-brand text-sm font-medium">To do</dd>
                    </dl>
                    <dl
                        class="bg-warning-soft border border-warning-subtle text-fg-warning rounded-base flex flex-col items-center justify-center h-[78px]">
                        <dt
                            class="w-8 h-8 rounded-full bg-warning-medium text-fg-warning text-sm font-medium flex items-center justify-center mb-1">
                            23</dt>
                        <dd class="text-fg-warning text-sm font-medium">In progress</dd>
                    </dl>
                    <dl
                        class="bg-success-soft border border-success-subtle text-fg-success-strong rounded-base flex flex-col items-center justify-center h-[78px]">
                        <dt
                            class="w-8 h-8 rounded-full bg-success-medium text-fg-success-strong text-sm font-medium flex items-center justify-center mb-1">
                            64</dt>
                        <dd class="text-fg-success-strong text-sm font-medium">Done</dd>
                    </dl>
                </div>
                <button data-collapse-toggle="more-details" type="button"
                    class="hover:underline text-sm text-body font-medium inline-flex items-center">
                    Show more details
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                </button>
                <div id="more-details" class="border-light border-t pt-3 mt-3 space-y-2 hidden">
                    <dl class="flex items-center justify-between">
                        <dt class="text-body text-sm font-normal">Average task completion rate:</dt>
                        <dd
                            class="inline-flex items-center bg-success-soft border border-success-subtle text-fg-success-strong text-xs font-medium px-1.5 py-0.5 rounded">
                            <svg class="w-4 h-4 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4" />
                            </svg>
                            57%
                        </dd>
                    </dl>
                    <dl class="flex items-center justify-between">
                        <dt class="text-body text-sm font-normal">Days until sprint ends:</dt>
                        <dd
                            class="inline-flex items-center bg-neutral-primary-medium border border-default-medium text-heading text-xs font-medium px-1.5 py-0.5 rounded">
                            13 days</dd>
                    </dl>
                    <dl class="flex items-center justify-between">
                        <dt class="text-body text-sm font-normal">Next meeting:</dt>
                        <dd
                            class="inline-flex items-center bg-neutral-primary-medium border border-default-medium text-heading text-xs font-medium px-1.5 py-0.5 rounded">
                            <svg class="w-3.5 h-3.5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                            </svg>
                            Thursday
                        </dd>
                    </dl>
                </div>
            </div>

            <!-- Radial Chart -->
            <div class="py-6" id="radial-chart"></div>

            <div class="grid grid-cols-1 items-center border-light border-t justify-between">
                <div class="flex justify-between items-center pt-4 md:pt-6">
                    <!-- Button -->
                    <button id="dropdownLastDays6Button" data-dropdown-toggle="LastDays6dropdown"
                        data-dropdown-placement="bottom"
                        class="text-sm font-medium text-body hover:text-heading text-center inline-flex items-center"
                        type="button">
                        Last 7 days
                        <svg class="w-4 h-4 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 9-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="LastDays6dropdown"
                        class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
                        <ul class="p-2 text-sm text-body font-medium" aria-labelledby="dropdownLastDays6Button">
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Yesterday</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Today</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Last
                                    7 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Last
                                    30 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Last
                                    90 days</a>
                            </li>
                        </ul>
                    </div>
                    <a href="#"
                        class="inline-flex items-center text-fg-brand bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-base text-sm px-3 py-2 focus:outline-none">
                        Progress report
                        <svg class="w-4 h-4 ms-1.5 -me-0.5 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

       


        {{-- line chart --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                // Get the CSS variable --color-brand and convert it to hex for ApexCharts
                const getBrandColor = () => {
                    // Get the computed style of the document's root element
                    const computedStyle = getComputedStyle(document.documentElement);

                    // Get the value of the --color-brand CSS variable
                    return computedStyle.getPropertyValue('--color-fg-brand').trim() || "#1447E6";
                };

                const getWarningColor = () => {
                    const computedStyle = getComputedStyle(document.documentElement);
                    return computedStyle.getPropertyValue('--color-warning').trim() || "#1447E6";
                };

                const getSuccessColor = () => {
                    const computedStyle = getComputedStyle(document.documentElement);
                    return computedStyle.getPropertyValue('--color-success').trim() || "#1447E6";
                };
                const getNeutralSecondaryMediumColor = () => {
                    const computedStyle = getComputedStyle(document.documentElement);
                    return computedStyle.getPropertyValue('--color-neutral-secondary-medium').trim() || "#1447E6";
                };


                const brandColor = getBrandColor();
                const warningColor = getWarningColor();
                const successColor = getSuccessColor();
                const neutralSecondaryMediumColor = getNeutralSecondaryMediumColor();

                const getChartOptions = () => {
                    return {
                        series: [90, 85, 70],
                        colors: [brandColor, warningColor, successColor],
                        chart: {
                            height: "350px",
                            width: "100%",
                            type: "radialBar",
                            sparkline: {
                                enabled: true,
                            },
                        },
                        plotOptions: {
                            radialBar: {
                                track: {
                                    background: neutralSecondaryMediumColor,
                                },
                                dataLabels: {
                                    show: false,
                                },
                                hollow: {
                                    margin: 0,
                                    size: "32%",
                                }
                            },
                        },
                        grid: {
                            show: false,
                            strokeDashArray: 4,
                            padding: {
                                left: 2,
                                right: 2,
                                top: -23,
                                bottom: -20,
                            },
                        },
                        labels: ["To do", "In progress", "Done"],
                        legend: {
                            show: true,
                            position: "bottom",
                            fontFamily: "Inter, sans-serif",
                        },
                        tooltip: {
                            enabled: true,
                            x: {
                                show: false,
                            },
                        },
                        yaxis: {
                            show: false,
                            labels: {
                                formatter: function(value) {
                                    return value + '%';
                                }
                            }
                        }
                    }
                }

                if (document.getElementById("radial-chart") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.querySelector("#radial-chart"), getChartOptions());
                    chart.render();
                }

            })
        </script>
        {{-- radial chart --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const getBrandColor = () => {
                    const computedStyle = getComputedStyle(document.documentElement);
                    return computedStyle.getPropertyValue('--color-fg-brand').trim() || "#1A56DB";
                };

                const getBrandSecondaryColor = () => {
                    const computedStyle = getComputedStyle(document.documentElement);
                    return computedStyle.getPropertyValue('--color-fg-brand-subtle').trim() || "#93C5FD";
                };

                const brandColor = getBrandColor();
                const brandSecondaryColor = getBrandSecondaryColor();

                const options = {
                    colors: [brandColor, brandSecondaryColor],
                    series: [{
                            name: "Organic",
                            color: brandColor,
                            data: [{
                                    x: "Mon",
                                    y: 231
                                },
                                {
                                    x: "Tue",
                                    y: 122
                                },
                                {
                                    x: "Wed",
                                    y: 63
                                },
                                {
                                    x: "Thu",
                                    y: 421
                                },
                                {
                                    x: "Fri",
                                    y: 122
                                },
                                {
                                    x: "Sat",
                                    y: 323
                                },
                                {
                                    x: "Sun",
                                    y: 111
                                },
                            ],
                        },
                        {
                            name: "Social media",
                            color: brandSecondaryColor,
                            data: [{
                                    x: "Mon",
                                    y: 232
                                },
                                {
                                    x: "Tue",
                                    y: 113
                                },
                                {
                                    x: "Wed",
                                    y: 341
                                },
                                {
                                    x: "Thu",
                                    y: 224
                                },
                                {
                                    x: "Fri",
                                    y: 522
                                },
                                {
                                    x: "Sat",
                                    y: 411
                                },
                                {
                                    x: "Sun",
                                    y: 243
                                },
                            ],
                        },
                    ],
                    chart: {
                        type: "bar",
                        height: "320px",
                        fontFamily: "Inter, sans-serif",
                        toolbar: {
                            show: false
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: "70%",
                            borderRadiusApplication: "end",
                            borderRadius: 8,
                        },
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        style: {
                            fontFamily: "Inter, sans-serif"
                        },
                    },
                    states: {
                        hover: {
                            filter: {
                                type: "darken",
                                value: 1
                            },
                        },
                    },
                    stroke: {
                        show: true,
                        width: 0,
                        colors: ["transparent"],
                    },
                    grid: {
                        show: false,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: -14
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false
                    },
                    xaxis: {
                        floating: false,
                        labels: {
                            show: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-body'
                            }
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                    },
                    yaxis: {
                        show: false
                    },
                    fill: {
                        opacity: 1
                    },
                };

                if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.getElementById("column-chart"), options);
                    chart.render();
                }
            });
        </script>

    </div>
     <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3">
            <div
                class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">New products</h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">2,340</span>
                    <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                        <span class="flex items-center mr-1.5 text-sm text-green-500 dark:text-green-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                                </path>
                            </svg>
                            12.5%
                        </span>
                        Since last month
                    </p>
                </div>
                <div class="w-full" id="new-products-chart"></div>
            </div>
            <div
                class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Users</h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">2,340</span>
                    <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                        <span class="flex items-center mr-1.5 text-sm text-green-500 dark:text-green-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                                </path>
                            </svg>
                            3,4%
                        </span>
                        Since last month
                    </p>
                </div>
                <div class="w-full" id="week-signups-chart"></div>
            </div>
            <div
                class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="mb-2 text-base font-normal text-gray-500 dark:text-gray-400">Audience by age</h3>
                    <div class="flex items-center mb-2">
                        <div class="w-16 text-sm font-medium dark:text-white">50+</div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: 18%"></div>
                        </div>
                    </div>
                    <div class="flex items-center mb-2">
                        <div class="w-16 text-sm font-medium dark:text-white">40+</div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: 15%"></div>
                        </div>
                    </div>
                    <div class="flex items-center mb-2">
                        <div class="w-16 text-sm font-medium dark:text-white">30+</div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: 60%"></div>
                        </div>
                    </div>
                    <div class="flex items-center mb-2">
                        <div class="w-16 text-sm font-medium dark:text-white">20+</div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: 30%"></div>
                        </div>
                    </div>
                </div>
                <div id="traffic-channels-chart" class="w-full"></div>
            </div>
        </div>

@endsection
