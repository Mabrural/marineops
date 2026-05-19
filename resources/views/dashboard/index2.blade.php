@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <!-- Header -->
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Overview of your system’s performance and activity summary</h6>
                </div>
            </div>

            <!-- Statistic Cards -->
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-ship"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Vessels</p>
                                        <h4 class="card-title">{{ $totalVessels ?? '0' }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Clients</p>
                                        <h4 class="card-title">{{ $totalClients ?? '0' }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-luggage-cart"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Projects</p>
                                        <h4 class="card-title">{{ $totalProjects ?? '0' }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="far fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Assets</p>
                                        <h4 class="card-title">{{ $totalAssets ?? '0' }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Calendar -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">
                                    <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                    Calendar
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('styles')
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

    <style>
        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }

        .fc .fc-toolbar-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .fc-theme-standard .fc-scrollgrid {
            border-radius: 10px;
            overflow: hidden;
        }

        .fc .fc-button {
            background-color: #1572E8;
            border-color: #1572E8;
        }

        .fc .fc-button:hover {
            background-color: #1269db;
            border-color: #1269db;
        }

        .fc .fc-daygrid-day-number {
            color: #495057;
            font-weight: 500;
        }

        .fc .fc-col-header-cell-cushion {
            color: #1572E8;
            font-weight: 600;
            text-decoration: none;
        }
    </style>
@endpush

@push('scripts')
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                locale: 'en',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Today',
                    month: 'Month',
                    week: 'Week',
                    day: 'Day'
                },
                selectable: true,
                editable: false,
                navLinks: true,
                dayMaxEvents: true,

                // Contoh event
                events: [{
                        title: 'Project Meeting',
                        start: new Date().toISOString().split('T')[0]
                    },
                    {
                        title: 'Vessel Inspection',
                        start: new Date(new Date().setDate(new Date().getDate() + 3))
                            .toISOString().split('T')[0]
                    }
                ]
            });

            calendar.render();
        });
    </script>
@endpush
