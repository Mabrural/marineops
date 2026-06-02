@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <!-- Header -->
            <div class="d-flex align-items-left align-items-md-left flex-column flex-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Overview of your system's performance and activity summary</h6>
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
                            <div class="card-head-row d-flex justify-content-between align-items-center">
                                <div class="card-title">
                                    <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                    Calendar
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-sm" onclick="filterByDateRange()">
                                        <i class="fas fa-filter me-1"></i> Filter by Date Range
                                    </button>
                                    <button class="btn btn-success btn-sm ms-2" onclick="openAddAgendaModal()">
                                        <i class="fas fa-plus me-1"></i> Add Agenda
                                    </button>
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

    <!-- Add/Edit Agenda Modal -->
    <div class="modal fade" id="agendaModal" tabindex="-1" role="dialog" aria-labelledby="agendaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agendaModalLabel">Add Agenda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="closeAgendaModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="agendaForm">
                    <div class="modal-body">
                        <input type="hidden" id="agenda_id">
                        <div class="form-group">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required
                                placeholder="Enter agenda title">
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                            <small class="form-text text-muted">Leave empty for single date agenda</small>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="all_day" name="all_day" checked>
                                <label class="form-check-label" for="all_day">
                                    All Day Event
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color">Color</label>
                            <input type="color" class="form-control" id="color" name="color" value="#1572E8"
                                style="height: 40px; padding: 5px;">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="Enter agenda description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeAgendaModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Date Range Filter Modal -->
    <div class="modal fade" id="dateRangeModal" tabindex="-1" role="dialog" aria-labelledby="dateRangeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateRangeModalLabel">Filter Agendas by Date Range</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="closeDateRangeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="filter_start_date">Start Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="filter_start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="filter_end_date">End Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="filter_end_date" required>
                    </div>
                    <div id="filteredAgendasResult" class="mt-3" style="display: none;">
                        <h6 class="fw-bold">Results:</h6>
                        <div id="filteredAgendasList" class="list-group">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeDateRangeModal()">Close</button>
                    <button type="button" class="btn btn-primary" onclick="applyDateRangeFilter()">Apply Filter</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Agenda Details Modal -->
    <div class="modal fade" id="viewAgendaModal" tabindex="-1" role="dialog" aria-labelledby="viewAgendaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewAgendaModalLabel">Agenda Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="closeViewAgendaModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="agendaDetails">
                        <h5 id="viewTitle" class="fw-bold mb-3"></h5>
                        <div class="mb-2">
                            <strong><i class="fas fa-calendar-check me-2"></i>Start Date:</strong>
                            <span id="viewStartDate"></span>
                        </div>
                        <div class="mb-2">
                            <strong><i class="fas fa-calendar-times me-2"></i>End Date:</strong>
                            <span id="viewEndDate"></span>
                        </div>
                        <div class="mb-2">
                            <strong><i class="fas fa-clock me-2"></i>All Day:</strong>
                            <span id="viewAllDay"></span>
                        </div>
                        <div class="mb-3">
                            <strong><i class="fas fa-align-left me-2"></i>Description:</strong>
                            <p id="viewDescription" class="mt-1"></p>
                        </div>
                        <div id="viewColor" class="mt-2 p-2 text-white rounded" style="display: inline-block;">
                            Color Indicator
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteAgendaBtn" onclick="deleteAgenda()">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                    <button type="button" class="btn btn-warning" id="editAgendaBtn" onclick="editAgendaFromView()">
                        <i class="fas fa-edit me-1"></i> Edit
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="closeViewAgendaModal()">Close</button>
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

        .fc {
            color: #333 !important;
            background: white !important;
        }

        .fc .fc-toolbar-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1a1a1a !important;
        }

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

        .fc .fc-button-primary {
            background-color: #1572E8 !important;
            border-color: #1572E8 !important;
        }

        .fc .fc-button-primary:not(:disabled):active,
        .fc .fc-button-primary:not(:disabled).fc-button-active {
            background-color: #0e5ab5 !important;
            border-color: #0e5ab5 !important;
        }

        .fc .fc-col-header-cell-cushion {
            color: #1572E8 !important;
            font-weight: 600 !important;
            text-decoration: none !important;
        }

        .fc .fc-daygrid-day-number {
            color: #333 !important;
            font-weight: 500 !important;
            text-decoration: none !important;
        }

        .fc .fc-day-past .fc-daygrid-day-number {
            color: #999 !important;
        }

        .fc .fc-day-today .fc-daygrid-day-number {
            color: #1572E8 !important;
            font-weight: 700 !important;
        }

        .fc .fc-day-today {
            background-color: rgba(21, 114, 232, 0.08) !important;
        }

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

        .fc .fc-daygrid-event .fc-event-title {
            color: white !important;
            font-weight: 500 !important;
        }

        .fc .fc-list-event {
            background-color: #f8f9fa !important;
        }

        .fc .fc-list-event:hover td {
            background-color: #e9ecef !important;
        }

        .fc .fc-list-event-title {
            color: #333 !important;
        }

        .fc .fc-list-event-time {
            color: #666 !important;
        }

        .fc-theme-standard .fc-scrollgrid {
            border-radius: 10px;
            overflow: hidden;
            border-color: #e0e0e0 !important;
        }

        .fc-theme-standard td,
        .fc-theme-standard th {
            border-color: #e0e0e0 !important;
        }

        .fc .fc-daygrid-more-link {
            color: #1572E8 !important;
            font-weight: 500 !important;
        }

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

        .fc .fc-timegrid-axis-cushion,
        .fc .fc-timegrid-slot-label-cushion {
            color: #666 !important;
        }

        .fc .fc-timegrid-slot-label {
            color: #666 !important;
        }

        .fc-scroller-harness {
            scrollbar-width: thin;
        }

        .list-group-item {
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .list-group-item:hover {
            background-color: #f0f0f0;
        }

        #agendaDetails .mb-2 {
            padding: 5px 0;
        }

        #agendaDetails strong {
            display: inline-block;
            min-width: 120px;
        }
    </style>
@endpush

@push('scripts')
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <script>
        let calendar;
        let currentViewAgendaId = null;

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');

            calendar = new FullCalendar.Calendar(calendarEl, {
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

                events: function(fetchInfo, successCallback, failureCallback) {
                    fetchAgendas(successCallback, failureCallback);
                },

                eventDisplay: 'block',
                eventColor: '#1572E8',
                eventTextColor: '#ffffff',

                dateClick: function(info) {
                    openAddAgendaModal(info.dateStr);
                },

                eventClick: function(info) {
                    viewAgenda(info.event.id);
                }
            });

            calendar.render();

            // Handle form submission
            document.getElementById('agendaForm').addEventListener('submit', function(e) {
                e.preventDefault();
                saveAgenda();
            });
        });

        /**
         * Format date dari ISO string ke format DD-MM-YYYY
         */
        function formatDate(dateString) {
            if (!dateString) return '-';

            // Handle ISO date string (contoh: 2026-06-02T17:00:00.000000Z)
            const date = new Date(dateString);

            // Cek jika date valid
            if (isNaN(date.getTime())) return dateString;

            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            return `${day}-${month}-${year}`;
        }

        /**
         * Format date ke YYYY-MM-DD untuk input type="date"
         */
        function formatDateForInput(dateString) {
            if (!dateString) return '';

            const date = new Date(dateString);

            if (isNaN(date.getTime())) return dateString;

            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            return `${year}-${month}-${day}`;
        }

        /**
         * Menambahkan 1 hari ke tanggal untuk FullCalendar
         * FullCalendar menggunakan exclusive end date, jadi kita perlu menambahkan 1 hari
         * agar tanggal end date termasuk dalam range yang ditampilkan
         */
        function addOneDay(dateString) {
            if (!dateString) return dateString;

            const date = new Date(dateString);
            date.setDate(date.getDate() + 1);

            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            return `${year}-${month}-${day}`;
        }

        function fetchAgendas(successCallback, failureCallback) {
            fetch('/agendas', {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const events = data.map(agenda => ({
                        id: agenda.id.toString(),
                        title: agenda.title,
                        start: agenda.start_date,
                        // Tambahkan 1 hari ke end_date untuk FullCalendar
                        // agar tanggal end_date termasuk dalam range yang ditampilkan
                        end: agenda.end_date ? addOneDay(agenda.end_date) : addOneDay(agenda.start_date),
                        allDay: agenda.all_day,
                        color: agenda.color,
                        textColor: '#ffffff'
                    }));
                    successCallback(events);
                })
                .catch(error => {
                    console.error('Error fetching agendas:', error);
                    failureCallback(error);
                });
        }

        function openAddAgendaModal(dateStr = null) {
            document.getElementById('agendaForm').reset();
            document.getElementById('agenda_id').value = '';
            document.getElementById('agendaModalLabel').textContent = 'Add Agenda';
            document.getElementById('color').value = '#1572E8';
            document.getElementById('all_day').checked = true;

            if (dateStr) {
                document.getElementById('start_date').value = dateStr;
                document.getElementById('end_date').value = dateStr;
            } else {
                document.getElementById('start_date').value = '';
                document.getElementById('end_date').value = '';
            }

            $('#agendaModal').modal('show');
        }

        function closeAgendaModal() {
            $('#agendaModal').modal('hide');
        }

        function saveAgenda() {
            const id = document.getElementById('agenda_id').value;
            const title = document.getElementById('title').value;
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value || startDate;
            const allDay = document.getElementById('all_day').checked;
            const color = document.getElementById('color').value;
            const description = document.getElementById('description').value;

            if (!title || !startDate) {
                alert('Title and Start Date are required');
                return;
            }

            const data = {
                title: title,
                start_date: startDate,
                end_date: endDate,
                all_day: allDay,
                color: color,
                description: description
            };

            const url = id ? `/agendas/${id}` : '/agendas';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        calendar.refetchEvents();
                        closeAgendaModal();
                        alert(result.message);
                    } else {
                        let errorMessage = 'Error saving agenda:\n';
                        if (result.errors) {
                            Object.keys(result.errors).forEach(key => {
                                errorMessage += `${result.errors[key].join('\n')}\n`;
                            });
                        }
                        alert(errorMessage);
                    }
                })
                .catch(error => {
                    console.error('Error saving agenda:', error);
                    alert('Failed to save agenda. Please try again.');
                });
        }

        function viewAgenda(id) {
            fetch(`/agendas/${id}`, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(agenda => {
                    currentViewAgendaId = agenda.id;

                    // Format tanggal dengan fungsi formatDate
                    document.getElementById('viewTitle').textContent = agenda.title;
                    document.getElementById('viewStartDate').textContent = formatDate(agenda.start_date);
                    document.getElementById('viewEndDate').textContent = formatDate(agenda.end_date);
                    document.getElementById('viewAllDay').textContent = agenda.all_day ? 'Yes' : 'No';
                    document.getElementById('viewDescription').textContent = agenda.description || 'No description';

                    const colorDiv = document.getElementById('viewColor');
                    colorDiv.style.backgroundColor = agenda.color;
                    colorDiv.textContent = agenda.color;

                    $('#viewAgendaModal').modal('show');
                })
                .catch(error => {
                    console.error('Error fetching agenda:', error);
                    alert('Failed to load agenda details');
                });
        }

        function closeViewAgendaModal() {
            $('#viewAgendaModal').modal('hide');
            currentViewAgendaId = null;
        }

        function editAgendaFromView() {
            if (!currentViewAgendaId) return;

            fetch(`/agendas/${currentViewAgendaId}`, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(agenda => {
                    // Set nilai form untuk edit
                    document.getElementById('agenda_id').value = agenda.id;
                    document.getElementById('title').value = agenda.title;
                    document.getElementById('start_date').value = formatDateForInput(agenda.start_date);
                    document.getElementById('end_date').value = formatDateForInput(agenda.end_date);
                    document.getElementById('all_day').checked = agenda.all_day;
                    document.getElementById('color').value = agenda.color;
                    document.getElementById('description').value = agenda.description || '';
                    document.getElementById('agendaModalLabel').textContent = 'Edit Agenda';

                    // Tutup view modal dan buka edit modal
                    closeViewAgendaModal();
                    $('#agendaModal').modal('show');
                })
                .catch(error => {
                    console.error('Error fetching agenda:', error);
                    alert('Failed to load agenda for editing');
                });
        }

        function deleteAgenda() {
            if (!currentViewAgendaId) return;

            if (!confirm('Are you sure you want to delete this agenda?')) return;

            fetch(`/agendas/${currentViewAgendaId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        calendar.refetchEvents();
                        closeViewAgendaModal();
                        alert(result.message);
                    } else {
                        alert('Failed to delete agenda');
                    }
                })
                .catch(error => {
                    console.error('Error deleting agenda:', error);
                    alert('Failed to delete agenda. Please try again.');
                });
        }

        function filterByDateRange() {
            // Reset filter form
            document.getElementById('filter_start_date').value = '';
            document.getElementById('filter_end_date').value = '';
            document.getElementById('filteredAgendasResult').style.display = 'none';
            document.getElementById('filteredAgendasList').innerHTML = '';

            $('#dateRangeModal').modal('show');
        }

        function closeDateRangeModal() {
            $('#dateRangeModal').modal('hide');
        }

        function applyDateRangeFilter() {
            const startDate = document.getElementById('filter_start_date').value;
            const endDate = document.getElementById('filter_end_date').value;

            if (!startDate || !endDate) {
                alert('Please select both start and end dates');
                return;
            }

            fetch('/agendas/date-range', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        start_date: startDate,
                        end_date: endDate
                    })
                })
                .then(response => response.json())
                .then(result => {
                    const listDiv = document.getElementById('filteredAgendasList');
                    listDiv.innerHTML = '';

                    if (result.data && result.data.length > 0) {
                        result.data.forEach(agenda => {
                            const item = document.createElement('a');
                            item.className = 'list-group-item list-group-item-action';
                            item.href = '#';
                            item.innerHTML = `
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">${agenda.title}</h6>
                                <small>${formatDate(agenda.start_date)} - ${formatDate(agenda.end_date)}</small>
                            </div>
                            <p class="mb-1">${agenda.description || 'No description'}</p>
                            <small style="color: ${agenda.color}">
                                <i class="fas fa-circle"></i> ${agenda.all_day ? 'All Day' : 'Timed Event'}
                            </small>
                        `;
                            item.onclick = function(e) {
                                e.preventDefault();
                                viewAgenda(agenda.id);
                                closeDateRangeModal();
                            };
                            listDiv.appendChild(item);
                        });
                        document.getElementById('filteredAgendasResult').style.display = 'block';
                    } else {
                        listDiv.innerHTML =
                            '<div class="list-group-item text-center text-muted">No agendas found in this date range</div>';
                        document.getElementById('filteredAgendasResult').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error fetching agendas:', error);
                    alert('Failed to fetch agendas. Please try again.');
                });
        }
    </script>
@endpush
