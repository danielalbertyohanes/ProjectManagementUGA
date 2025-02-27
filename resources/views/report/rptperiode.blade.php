@extends('layouts.admin')

@section('content')
    <link href="{{ asset('admin/css/content.css') }}" rel="stylesheet">
    <div class="container-fluid mt-4">
        <h1 class="text-center mb-4 text-black" style="font-size: 3rem;">Laporan Periode</h1>

        @foreach ($periodes as $key => $periode)
            <div class="card mb-4">
                <div class="card-header text-white toggle-header" data-target="#report-{{ $key }}">
                    <h3 class="mb-0">{{ $periode['name'] }}</h3>
                    <h6 class="mb-0">
                        Periode: {{ \Carbon\Carbon::parse($periode['start_date'])->format('d-m-Y') }} -
                        {{ \Carbon\Carbon::parse($periode['end_date'])->format('d-m-Y') }} |
                        Kurasi: {{ \Carbon\Carbon::parse($periode['kurasi_date'])->format('d-m-Y') }} |
                        Status:
                        <span class="badge {{ $periode['status'] == 'Active' ? 'badge-success' : 'badge-danger' }}">
                            {{ ucfirst($periode['status']) }}
                        </span>
                    </h6>
                </div>
                <div class="card-body" id="report-{{ $key }}" style="display: none;">


                    @if ($periode['open_courses_count'] == 0)
                        <p class="text-center"><b>Belum ada Course yang tercatat pada Periode ini</b></p>
                    @else
                        <div class="card-body-header">
                            <!-- Tambahkan tombol Download PDF pad JS-->
                        </div>
                        <h4 class="mb-3">{{ $periode['name'] }}</h4>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Jumlah Course</th>
                                        <th>Total Topik</th>
                                        <th>Total Subtopik</th>
                                        <th>Total PPT</th>
                                        <th>Total Video</th>
                                        <th>Course Publish</th>
                                        <th>Course Belum Publish</th>
                                        <th>Progres (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $periode['open_courses_count'] }}</td>
                                        <td>{{ $periode['total_topics'] }}</td>
                                        <td>{{ $periode['total_subtopics'] }}</td>
                                        <td>{{ $periode['total_ppts'] }}</td>
                                        <td>{{ $periode['total_videos'] }}</td>
                                        <td>{{ $periode['completed_courses'] }}</td>
                                        <td>{{ $periode['not_completed_courses'] }}</td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $periode['progress_percentage'] }}%;"
                                                    aria-valuenow="{{ $periode['progress_percentage'] }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $periode['progress_percentage'] }}%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <h4 class="mb-3">Detail Course</h4>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <th>Nama Course</th>
                                    <th>Total Topic</th>
                                    <th>Total Subtopik</th>
                                    <th>Total PPT</th>
                                    <th>Total Video</th>
                                    <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($periode['courses'] as $course)
                                        <tr>
                                            <td>{{ $course['name'] }}</td>
                                            <td>{{ $course['total_topics'] }}</td>
                                            <td>{{ $course['total_subtopics'] }}</td>
                                            <td>{{ $course['total_ppts'] }}</td>
                                            <td>{{ $course['total_videos'] }}</td>
                                            <td>
                                                <span
                                                    class="badge 
                                                    bg-{{ $course['status'] === 'Publish' ? 'success' : ($course['status'] === 'Cancel' ? 'danger' : 'warning') }}">
                                                    {{ $course['status'] }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        $(document).ready(function() {
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

            $('.card').each(function(index) {
                var card = $(this);
                var userName = card.find('.card-header h3').text().trim();
                var fileName = 'Laporan_Kerja_' + userName.replace(/\s+/g, '_');

                // Tambahkan tombol download ke dalam card-body-header
                var downloadButton = $('<button>', {
                    text: 'Download PDF',
                    class: 'btn buttonCreate btn-download-pdf',
                    click: function() {
                        generatePDF(card[0], fileName); // Pastikan fungsi generatePDF dipanggil
                    }
                });

                // Tempatkan tombol di dalam card-body-header
                card.find('.card-body-header').append(downloadButton);
            });
        });
    </script>
@endsection
