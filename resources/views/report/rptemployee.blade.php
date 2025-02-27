@extends('layouts.admin')

@section('content')
    <style>
        .card-body-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .btn-download-pdf {
            margin-left: auto;
        }
    </style>
    <div class="container-fluid mt-4">
        <h1 class="text-center mb-4 text-black" style="font-size: 3rem;">Laporan Kerja Karyawan</h1>

        @foreach ($employeeReports as $key => $report)
            <div class="card mb-4">
                <div class="card-header text-white toggle-header" data-target="#report-{{ $key }}">
                    <h3 class="mb-0">{{ $report['user']->name }}</h3>
                    <h6 class="mb-0">
                        Total Courses (PIC): {{ $report['courses_count'] }} |
                        Total Tugas: {{ $report['total_tasks'] }}
                    </h6>
                </div>

                <div class="card-body" id="report-{{ $key }}" style="display: none;">


                    <div class="card-body-header">
                        <!-- Tambahkan tombol Download PDF pad JS-->
                    </div>

                    <!-- Courses Section -->
                    @if ($report['courses_count'] > 0)
                        <h4 class="mb-3">Courses (PIC)</h4>
                        <div class="table-responsive mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Course</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($report['courses'] as $course)
                                        <tr>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ $course->description }}</td>
                                            <td><span
                                                    class="badge bg-{{ $course->status === 'active' ? 'success' : 'warning' }}">
                                                    {{ $course->status }}
                                                </span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada Mata pelajaran</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <!-- PPT Logs Section -->
                    @if ($report['ppt_logs']->count() > 0)
                        <h4 class="mb-3">Aktivitas PPT</h4>
                        <div class="table-responsive mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama PPT</th>
                                        <th>Aksi</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($report['ppt_logs'] as $log)
                                        <tr>
                                            <td>{{ $log->ppt->name }}</td>
                                            <td>{{ $log->status }}</td>
                                            <td>{{ ucwords(str_replace('-', ' ', $log->description)) }}</td>
                                            <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                                            <td><span
                                                    class="badge bg-{{ $log->ppt->status === 'Finished' ? 'success' : 'warning' }}">
                                                    {{ $log->ppt->status }}
                                                </span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada Aktivitas</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <!-- Video Logs Section -->
                    @if ($report['video_logs']->count() > 0)
                        <h4 class="mb-3">Aktivitas Video</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Video</th>
                                        <th>Aksi</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($report['video_logs'] as $log)
                                        <tr>
                                            <td>{{ $log->video->name }}</td>
                                            <td>{{ $log->status }}</td>
                                            <td>{{ ucwords(str_replace('-', ' ', $log->description)) }}</td>
                                            <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                                        
                                            <td><span
                                                    class="badge bg-{{ $log->video->status === 'Edited' ? 'success' : 'warning' }}">
                                                    {{ $log->video->status }}
                                                </span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada Aktivitas</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('javascript')
    <!-- Tambahkan library jsPDF dan html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle card body
            $(".toggle-header").click(function() {
                var target = $(this).data("target");
                $(target).slideToggle();
            });

            // Fungsi untuk generate PDF
            function generatePDF(cardElement, fileName) {
                html2canvas(cardElement, {
                    scale: 2, // Tingkatkan skala untuk kualitas yang lebih baik
                    logging: true,
                    useCORS: true
                }).then(function(canvas) {
                    var imgData = canvas.toDataURL('image/png');
                    var pdf = new jspdf.jsPDF('p', 'mm', 'a4'); // A4 size page of PDF
                    var imgWidth = 210; // A4 width in mm
                    var pageHeight = 295; // A4 height in mm
                    var imgHeight = canvas.height * imgWidth / canvas.width;
                    var heightLeft = imgHeight;
                    var position = 0;

                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;

                    while (heightLeft >= 0) {
                        position = heightLeft - imgHeight;
                        pdf.addPage();
                        pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                        heightLeft -= pageHeight;
                    }

                    pdf.save(fileName + '.pdf'); // Save PDF
                });
            }

            // Tambahkan tombol download PDF untuk setiap card
            $('.card').each(function(index) {
                var card = $(this);
                var userName = card.find('.card-header h3').text().trim();
                var fileName = 'Laporan_Kerja_' + userName.replace(/\s+/g, '_');

                // Tambahkan tombol download ke dalam card-body-header
                var downloadButton = $('<button>', {
                    text: 'Download PDF',
                    class: 'btn buttonCreate btn-download-pdf',
                    click: function() {
                        generatePDF(card[0], fileName);
                    }
                });

                // Tempatkan tombol di dalam card-body-header
                card.find('.card-body-header').append(downloadButton);
            });
        });
    </script>
@endsection
