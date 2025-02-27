@extends('layouts.admin')

@section('content')
    <link href="{{ asset('admin/css/content.css') }}" rel="stylesheet">
    <style>
        .filters-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            /* Agar tombol sejajar dengan dropdown */
            gap: 20px;
            /* Jarak antara filter dan tombol */
        }

        .filters-row {
            display: flex;
            flex: 1;
            /* Mengisi sisa ruang yang tersedia */
            gap: 20px;
            /* Jarak antara dropdown */
        }

        .button-container {
            flex-shrink: 0;
            /* Mencegah tombol menyusut */
        }
    </style>
    <div class="container-fluid mt-4">
        <h1 class="text-center mb-4 text-black" style="font-size: 3rem;">Workload Analysis</h1>

        <!-- Filters Row -->
        <div class="filters-container mb-4">
            <div class="filters-row">
                <div class="col-md-6">
                    <select id="periodeDropdown" class="form-control">
                        <option value="">Semua Periode</option>
                        @foreach ($periodes as $periode)
                            <option value="{{ $periode->id }}" {{ $periode->id == $activePeriodeId ? 'selected' : '' }}>
                                {{ $periode->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <select id="picDropdown" class="form-control">
                        <option value="">Semua PIC</option>
                        @foreach ($groupedByPic as $picName => $groupedCourses)
                            <option value="{{ $picName }}">{{ $picName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tombol Download All PDF -->
            <div class="button-container">
                <button id="downloadAllButton" class="btn buttonCreate btn-download-all-pdf">Download All PDF</button>
            </div>
        </div>

        <div id="coursesContainer">
            @foreach ($groupedByPic as $picName => $groupedCourses)
                <div class="picCourses" id="picCourses-{{ Str::slug($picName) }}" data-pic="{{ $picName }}"
                    data-periode="{{ $groupedCourses->pluck('periode')->flatten()->pluck('id')->unique()->implode(',') }}">
                    @foreach ($groupedCourses as $course)
                        <div class="card shadow-lg mb-4">
                            <div class="card-header text-white"
                                style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h3 class="mb-0">{{ $course->name }}</h3>
                                    <h6 class="mb-1">Deskripsi: {{ $course->description }}</h6>
                                    <h6 class="mb-1">Status: {{ ucfirst($course->status) }}</h6>
                                    <h6 class="mb-1">PIC: {{ $course->user->name }}</h6>
                                </div>
                                <!-- Tempat untuk tombol Download PDF -->
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Tugas</th>
                                            <th>Status</th>
                                            <th>Durasi (hari kerja)</th>
                                            <th>Waktu Puncak Kerja</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($course->topics as $topic)
                                            <tr class="table-info">
                                                <td><strong>{{ $topic->name }}</strong></td>
                                                <td>Topic</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $topic->status === 'Finish' ? 'success' : 'warning' }}">
                                                        {{ $topic->status }}
                                                    </span>
                                                </td>
                                                <td>--</td>
                                                <td>--</td>
                                            </tr>
                                            @foreach ($topic->subTopics as $subTopic)
                                                @foreach ($subTopic->ppts as $ppt)
                                                    <tr>
                                                        <td>{{ $ppt->name }}</td>
                                                        <td>PPT</td>
                                                        <td>
                                                            <span
                                                                class="badge bg-{{ $ppt->status === 'Finished' ? 'success' : 'warning' }}">
                                                                {{ $ppt->status }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @php
                                                                $started_at = \Carbon\Carbon::parse($ppt->started_at);
                                                                $finished_at = \Carbon\Carbon::parse($ppt->finished_at);
                                                            @endphp
                                                            {{ $finished_at->diffInDays($started_at) }} days
                                                        </td>
                                                        <td>
                                                            {{ $ppt->started_at ? \Carbon\Carbon::parse($ppt->started_at)->format('d-M-Y') : '-' }}
                                                            -
                                                            {{ $ppt->finished_at ? \Carbon\Carbon::parse($ppt->finished_at)->format('d-M-Y') : '-' }}
                                                        </td>
                                                    </tr>
                                                    @foreach ($ppt->videos as $video)
                                                        <tr>
                                                            <td>{{ $video->name }}</td>
                                                            <td>Video</td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-{{ $video->status === 'Edited' ? 'success' : 'warning' }}">
                                                                    {{ $video->status }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                @php
                                                                    $started_at = \Carbon\Carbon::parse(
                                                                        $video->started_at,
                                                                    );
                                                                    $finished_at = \Carbon\Carbon::parse(
                                                                        $video->finished_at,
                                                                    );
                                                                @endphp
                                                                {{ $finished_at->diffInDays($started_at) }} days
                                                            </td>
                                                            <td>
                                                                {{ $video->started_at ? \Carbon\Carbon::parse($video->started_at)->format('d-M-Y') : '-' }}
                                                                -
                                                                {{ $video->finished_at ? \Carbon\Carbon::parse($video->finished_at)->format('d-M-Y') : '-' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const picDropdown = document.getElementById('picDropdown');
            const periodeDropdown = document.getElementById('periodeDropdown');

            function filterCourses() {
                const selectedPIC = picDropdown.value;
                const selectedPeriode = periodeDropdown.value;

                document.querySelectorAll('.picCourses').forEach(container => {
                    const coursePIC = container.dataset.pic;
                    const coursePeriodes = container.dataset.periode.split(',');

                    const picMatch = !selectedPIC || selectedPIC === coursePIC;
                    const periodeMatch = !selectedPeriode || coursePeriodes.includes(selectedPeriode);

                    container.style.display = (picMatch && periodeMatch) ? 'block' : 'none';
                });
            }

            // Initial filter based on active period
            filterCourses();

            // Event listeners
            picDropdown.addEventListener('change', filterCourses);
            periodeDropdown.addEventListener('change', filterCourses);
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

            // Tambahkan tombol download
            var downloadButton = $('<button>', {
                text: 'Download PDF',
                class: 'btn buttonCreate btn-download-pdf',
                click: function() {
                    generatePDF(card[0], fileName);
                }
            });

            card.find('.card-header').append(downloadButton);
        });

        document.addEventListener("DOMContentLoaded", function() {
            const {
                jsPDF
            } = window.jspdf;

            function generatePDF(cardElements, fileName) {
                const pdf = new jsPDF('p', 'mm', 'a4');
                let position = 0;

                cardElements.forEach((cardElement, index) => {
                    html2canvas(cardElement, {
                        scale: 2,
                        useCORS: true
                    }).then(canvas => {
                        const imgData = canvas.toDataURL("image/png");
                        const imgWidth = 210; // Lebar A4 dalam mm
                        const imgHeight = (canvas.height * imgWidth) / canvas.width;

                        if (index !== 0) {
                            pdf.addPage();
                        }

                        pdf.addImage(imgData, "PNG", 0, position, imgWidth, imgHeight);

                        if (index === cardElements.length - 1) {
                            pdf.save(fileName + ".pdf");
                        }
                    }).catch(error => console.error("Error generating PDF:", error));
                });
            }

            const downloadAllButton = document.getElementById("downloadAllButton");
            downloadAllButton.onclick = () => {
                const allCards = document.querySelectorAll(".card");
                generatePDF(allCards, "Laporan_Kerja_Semua");
            };
        });

        document.querySelectorAll('.card').forEach(card => {
            card.style.display = 'block'; // Pastikan elemen terlihat
        });
    </script>
@endsection
