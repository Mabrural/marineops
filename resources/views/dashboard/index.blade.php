@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <!-- Header -->
            <div class="d-flex align-items-left align-items-md-left flex-column flex-row pt-2 pb-4">
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

        /* Perbaikan warna teks dan latar belakang kalender */
        .fc {
            color: #333 !important;
            background: white !important;
        }

        /* Header kalender (bulan/tahun) */
        .fc .fc-toolbar-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1a1a1a !important;
        }

        /* Tombol navigasi (Prev, Next, Today) */
        .fc .fc-button {
            background-color: #1572E8 !important;
            border-color: #1572E8 !important;
            color: white !important;
            font-weight: 500 !important;
        }

        .fc .fc-button:hover {
            background-color: #1269db !important;
            border-color: #1269db !important;
            color: white !important;
        }

        /* Tombol view (Month, Week, Day) */
        .fc .fc-button-primary {
            background-color: #1572E8 !important;
            border-color: #1572E8 !important;
        }

        .fc .fc-button-primary:not(:disabled):active,
        .fc .fc-button-primary:not(:disabled).fc-button-active {
            background-color: #0e5ab5 !important;
            border-color: #0e5ab5 !important;
        }

        /* Header hari (Sun, Mon, Tue, dst) */
        .fc .fc-col-header-cell-cushion {
            color: #1572E8 !important;
            font-weight: 600 !important;
            text-decoration: none !important;
        }

        /* Nomor tanggal */
        .fc .fc-daygrid-day-number {
            color: #333 !important;
            font-weight: 500 !important;
            text-decoration: none !important;
        }

        /* Tanggal yang sudah lewat */
        .fc .fc-day-past .fc-daygrid-day-number {
            color: #999 !important;
        }

        /* Tanggal sekarang */
        .fc .fc-day-today .fc-daygrid-day-number {
            color: #1572E8 !important;
            font-weight: 700 !important;
        }

        /* Background today */
        .fc .fc-day-today {
            background-color: rgba(21, 114, 232, 0.08) !important;
        }

        /* Event / Agenda */
        .fc .fc-daygrid-event {
            background-color: #1572E8 !important;
            border-color: #1572E8 !important;
            color: white !important;
            font-weight: 500 !important;
            border-radius: 4px !important;
            padding: 2px 4px !important;
            margin: 1px 2px !important;
            cursor: pointer !important;
        }

        .fc .fc-daygrid-event:hover {
            background-color: #1269db !important;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }

        /* Teks event */
        .fc .fc-daygrid-event .fc-event-title {
            color: white !important;
            font-weight: 500 !important;
        }

        /* Event di list view */
        .fc .fc-list-event {
            background-color: #f8f9fa !important;
        }

        .fc .fc-list-event:hover td {
            background-color: #e9ecef !important;
        }

        /* Warna teks event di list view */
        .fc .fc-list-event-title {
            color: #333 !important;
        }

        .fc .fc-list-event-time {
            color: #666 !important;
        }

        /* Grid border */
        .fc-theme-standard .fc-scrollgrid {
            border-radius: 10px;
            overflow: hidden;
            border-color: #e0e0e0 !important;
        }

        .fc-theme-standard td,
        .fc-theme-standard th {
            border-color: #e0e0e0 !important;
        }

        /* More link */
        .fc .fc-daygrid-more-link {
            color: #1572E8 !important;
            font-weight: 500 !important;
        }

        /* Popover untuk event yang banyak */
        .fc .fc-popover {
            background-color: white !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        }

        .fc .fc-popover-header {
            background-color: #1572E8 !important;
            color: white !important;
        }

        .fc .fc-popover-title {
            color: white !important;
        }

        /* Waktu di week/day view */
        .fc .fc-timegrid-axis-cushion,
        .fc .fc-timegrid-slot-label-cushion {
            color: #666 !important;
        }

        /* Slot time */
        .fc .fc-timegrid-slot-label {
            color: #666 !important;
        }

        /* Scrollbar styling */
        .fc-scroller-harness {
            scrollbar-width: thin;
        }
    </style>
@endpush

@push('scripts')
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');

            // Gunakan company_id user yang login sebagai key localStorage
            const companyId = "{{ Auth::user()->company->id ?? 'default' }}";
            const storageKey = `calendar_events_company_${companyId}`;

            /**
             * Ambil data event dari localStorage
             */
            function getEvents() {
                const events = localStorage.getItem(storageKey);
                return events ? JSON.parse(events) : [];
            }

            /**
             * Simpan data event ke localStorage
             */
            function saveEvents(events) {
                localStorage.setItem(storageKey, JSON.stringify(events));
            }

            /**
             * Inisialisasi FullCalendar
             */
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                locale: 'en',
                selectable: true,
                editable: false,
                navLinks: true,
                dayMaxEvents: true,

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

                // Load event dari localStorage
                events: getEvents(),

                // Warna event default (hitam untuk teks)
                eventDisplay: 'block',
                eventColor: '#1572E8',
                eventTextColor: '#ffffff',

                /**
                 * Klik tanggal untuk menambah agenda
                 */
                dateClick: function(info) {
                    const title = prompt(
                        `Masukkan agenda untuk tanggal ${info.dateStr}:`,
                        ''
                    );

                    if (title && title.trim() !== '') {
                        const newEvent = {
                            id: Date.now().toString(),
                            title: title.trim(),
                            start: info.dateStr,
                            allDay: true,
                            color: '#1572E8',
                            textColor: '#ffffff'
                        };

                        // Tambahkan ke kalender
                        calendar.addEvent(newEvent);

                        // Simpan ke localStorage
                        const events = getEvents();
                        events.push(newEvent);
                        saveEvents(events);

                        alert('Agenda berhasil disimpan.');
                    }
                },

                /**
                 * Klik event untuk lihat atau hapus
                 */
                eventClick: function(info) {
                    const event = info.event;

                    const action = confirm(
                        `Agenda:\n${event.title}\n\nKlik OK untuk menghapus agenda ini.`
                    );

                    if (action) {
                        // Hapus dari kalender
                        event.remove();

                        // Hapus dari localStorage
                        let events = getEvents();
                        events = events.filter(e => e.id !== event.id);
                        saveEvents(events);

                        alert('Agenda berhasil dihapus.');
                    }
                }
            });

            calendar.render();
        });
    </script>
@endpush
