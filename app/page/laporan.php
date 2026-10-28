    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">LAPORAN</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-2">
                                    <label for="start-date">Tanggal Awal:</label>
                                    <input type="date" class="form-control form-control-sm bg-primary text-white" id="start-date">
                                </div>
                                <div class="col-md-2">
                                    <label for="end-date">Tanggal Akhir:</label>
                                    <input type="date" class="form-control form-control-sm bg-primary text-white" id="end-date">
                                </div>
                                <div class="col-md-2">
                                    <label for="show-data">Show:</label>
                                    <div class="input-group input-group-sm">
                                        <select class="form-control bg-dark text-white" id="show-data">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="sort-by">Sort By:</label>
                                    <div class="input-group input-group-sm">
                                        <select class="form-control bg-dark text-white" id="sort-by">
                                            <option value="descp">Deskripsi</option>
                                            <option value="tgl_expired">Tanggal Expired</option>
                                            <option value="tgl_tarik">Tanggal Tarik</option>
                                            <option value="category">Kategori</option>
                                            <option value="tgl_input">Tanggal Input</option>
                                            <option value="user_input">User Input</option>
                                            <option value="tgl_confirm">Tanggal Konfirmasi</option>
                                            <option value="user_confirm">User Konfirmasi</option>
                                            <option value="status">Status</option>
                                            <option value="keterangan">Keterangan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="sort-order">Sort Order:</label>
                                    <div class="input-group input-group-sm">
                                        <select class="form-control bg-dark text-white" id="sort-order">
                                            <option value="asc">Ascending</option>
                                            <option value="desc">Descending</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2 mt-4">
                                    <button class="btn btn-primary" id="view-data-btn">Lihat Data</button>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <label for="cetak">Format:</label>
                                    <div class="input-group input-group-sm">
                                        <select class="form-control bg-dark text-white" id="cetak">
                                            <option value="pdf">PDF</option>
                                            <option value="excel">EXCEL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-5">
                                    <button class="btn btn-primary" id="print-data-btn">Cetak</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>PLU</th>
                                            <th>Barcode</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal Expired</th>
                                            <th>Retur Day</th>
                                            <th>Tanggal Tarik</th>
                                            <th>Jumlah Expired</th>
                                            <th>Planogram</th>
                                            <th>Tag</th>
                                            <th>Conv1</th>
                                            <th>Conv2</th>
                                            <th>Min Disp</th>
                                            <th>Sub Kategori</th>
                                            <th>Kategori</th>
                                            <th>Tanggal Input</th>
                                            <th>User Input</th>
                                            <th>Tanggal Konfirmasi</th>
                                            <th>User Konfirmasi</th>
                                            <th>Status</th>
                                            <th>Status Display</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="barisData">
                                        <!-- Data produk akan diisi melalui JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('print-data-btn').addEventListener('click', function() {
            var selectedOption = document.getElementById('cetak').value;

            if (selectedOption === 'pdf') {
                printToPDF();
            } else if (selectedOption === 'excel') {
                exportToExcel();
            }
        });



        function exportToExcel() {
            var table = document.getElementById('data-table');

            // Create a new Excel Workbook
            var workbook = new ExcelJS.Workbook();
            var worksheet = workbook.addWorksheet('Sheet 1');

            // Set header row styles
            var headerRow = worksheet.getRow(1);
            headerRow.eachCell({
                includeEmpty: true
            }, function(cell) {
                cell.fill = {
                    type: 'pattern',
                    pattern: 'solid',
                    fgColor: {
                        argb: 'D3D3D3'
                    }
                };
                cell.font = {
                    bold: true
                };
                cell.border = {
                    top: {
                        style: 'thin'
                    },
                    bottom: {
                        style: 'thin'
                    },
                    left: {
                        style: 'thin'
                    },
                    right: {
                        style: 'thin'
                    }
                };
                cell.alignment = {
                    vertical: 'middle',
                    horizontal: 'center'
                };
            });

            // Add title row
            var titleRow = worksheet.addRow(['Laporan']);
            titleRow.getCell(1).font = {
                bold: true,
                size: 16,
                underline: true
            };
            titleRow.getCell(1).alignment = {
                vertical: 'middle',
                horizontal: 'center'
            };

            // Merge title cells
            worksheet.mergeCells(`A${titleRow.number}:D${titleRow.number}`);

            // Copy table header data to the worksheet
            var headerCells = table.rows[0].cells;
            for (var j = 0; j < headerCells.length; j++) {
                var headerText = headerCells[j].innerText;
                var cell = worksheet.getCell(3, j + 1);
                cell.value = headerText;
                cell.border = {
                    top: {
                        style: 'thin'
                    },
                    bottom: {
                        style: 'thin'
                    },
                    left: {
                        style: 'thin'
                    },
                    right: {
                        style: 'thin'
                    }
                };
                cell.alignment = {
                    vertical: 'middle',
                    horizontal: 'center'
                };
            }

            // Set styles for data cells
            var dataRows = table.rows;
            for (var i = 1; i < dataRows.length; i++) {
                var dataCells = dataRows[i].cells;
                for (var j = 0; j < dataCells.length; j++) {
                    var dataText = dataCells[j].innerText;
                    var cell = worksheet.getCell(i + 3, j + 1);
                    cell.value = dataText;
                    cell.border = {
                        top: {
                            style: 'thin'
                        },
                        bottom: {
                            style: 'thin'
                        },
                        left: {
                            style: 'thin'
                        },
                        right: {
                            style: 'thin'
                        }
                    };
                    cell.alignment = {
                        vertical: 'middle',
                        horizontal: 'center'
                    };
                }
            }

            // Auto fit column widths
            worksheet.columns.forEach(function(column) {
                var maxLength = 0;
                column.eachCell({
                    includeEmpty: true
                }, function(cell) {
                    var columnLength = cell.value ? cell.value.toString().length : 10;
                    if (columnLength > maxLength) {
                        maxLength = columnLength;
                    }
                });
                column.width = maxLength < 10 ? 10 : maxLength + 2;
            });

            // Generate Excel file
            workbook.xlsx.writeBuffer().then(function(buffer) {
                var excelBlob = new Blob([buffer], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                var excelURL = URL.createObjectURL(excelBlob);

                // Create a temporary link element
                var link = document.createElement('a');
                link.href = excelURL;
                link.download = 'laporan.xlsx';

                // Simulate click event to trigger download
                link.click();

                // Clean up resources
                URL.revokeObjectURL(excelURL);
                document.body.removeChild(link);
            }).catch(function(success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Excel berhasil diunduh'
                });
            });
        }


        // Fungsi untuk memuat data ke tabel
        function loadData() {
            var startDate = document.getElementById('start-date').value;
            var endDate = document.getElementById('end-date').value;

            // Validasi tanggal awal dan akhir
            if (startDate === '' || endDate === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Tanggal awal dan akhir harus diisi!',
                });
                return;
            }

            // Validasi tanggal akhir tidak kurang dari tanggal awal
            if (startDate > endDate) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Tanggal akhir tidak boleh kurang dari tanggal awal!',
                });
                return;
            }

            var showBy = document.getElementById('show-data').value;
            var sortBy = document.getElementById('sort-by').value;
            var sortOrder = document.getElementById('sort-order').value;

            // Kirim permintaan AJAX ke server
            $.ajax({
                url: 'controller/laporan/laporan.php', // Ubah path sesuai dengan lokasi file laporan.php
                type: 'POST',
                dataType: 'json',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    show_by: showBy,
                    sort_by: sortBy,
                    sort_order: sortOrder
                },
                success: function(response) {
                    if (response.success) {
                        var data = response.data;
                        var rows = '';

                        for (var i = 0; i < data.length; i++) {
                            rows += '<tr>';
                            rows += '<td>' + data[i].no + '</td>';
                            rows += '<td>' + data[i].plu + '</td>';
                            rows += '<td>' + data[i].barcode + '</td>';
                            rows += '<td>' + data[i].deskripsi + '</td>';
                            rows += '<td>' + data[i].tgl_expired + '</td>';
                            rows += '<td>' + data[i].retur_day + '</td>';
                            rows += '<td>' + data[i].tgl_tarik + '</td>';
                            rows += '<td>' + data[i].jml_expired + '</td>';
                            rows += '<td>' + data[i].planogram + '</td>';
                            rows += '<td>' + data[i].tag + '</td>';
                            rows += '<td>' + data[i].conv1 + '</td>';
                            rows += '<td>' + data[i].conv2 + '</td>';
                            rows += '<td>' + data[i].min_disp + '</td>';
                            rows += '<td>' + data[i].sub_category + '</td>';
                            rows += '<td>' + data[i].category + '</td>';
                            rows += '<td>' + data[i].tgl_input + '</td>';
                            rows += '<td>' + data[i].user_input + '</td>';
                            rows += '<td>' + data[i].tgl_confirm + '</td>';
                            rows += '<td>' + data[i].user_confirm + '</td>';
                            rows += '<td>' + data[i].status + '</td>';
                            rows += '<td>' + data[i].status_disp + '</td>';
                            rows += '<td>' + data[i].keterangan + '</td>';
                            rows += '</tr>';
                        }

                        // Mengisi tabel dengan baris data
                        $('#barisData').html(rows);
                    } else {
                        // Menampilkan pesan jika tidak ada produk yang ditemukan
                        $('#barisData').html('<tr><td colspan="22">' + response.message + '</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        // Menggunakan event listener untuk memuat data ketika tombol "Lihat Data" diklik
        document.getElementById('view-data-btn').addEventListener('click', function() {
            loadData();
        });
    </script>