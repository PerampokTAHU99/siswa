<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/">SMKN 2 Rembang</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="/">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Siswa
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    anonim
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Informasi Siswa dan Siswi SMK Negeri 2 Rembang</h1>
                    <div class="card mb-3">
                        <div class="card-body">
                            <p>
                                Berikut ini adalah data informasi siswa dan siswi dari SMK Negeri 2 Rembang. Anda
                                memiliki kemampuan untuk menambahkan, mengedit, serta menghapus informasi dari data yang
                                telah disediakan. Pastikan untuk memperbarui data secara berkala agar informasi yang
                                tercatat tetap akurat dan terkini. Silakan lakukan pembaruan sesuai kebutuhan dengan
                                akses yang diberikan.
                            </p>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Siswa
                            <!-- Corrected data attributes -->
                            <button type="button" data-bs-target="#createModal" data-bs-toggle="modal"
                                class="btn btn-primary btn-capsule">+ Tambah Siswa</button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Prestasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $s)
                                    <tr>
                                        <td>{{ $s->nama }}</td>
                                        <td>{{ $s->tempat_lahir }}, {{ \Carbon\Carbon::parse($s->tanggal_lahir)->format('d/m/Y') }}</td>
                                        <td>{{ $s->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                        <td>{{ $s->alamat }}</td>
                                        <td>{{ $s->kelas }}</td>
                                        <td>{{ $s->jurusan }}</td>
                                        <td>{{ $s->prestasi }}</td>
                                        <td>
                                            <div class="container text-center">
                                                <ul class="list-inline m-0 d-flex justify-content-center">
                                                    <li class="list-inline-item mx-2">
                                                        <button class="btn btn-success btn-sm rounded-0" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#editModal{{ $s->id }}" 
                                                            data-placement="top" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </li>
                                                    <li class="list-inline-item mx-2">
                                                        <button class="btn btn-danger btn-sm rounded-0" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $s->id }}" 
                                                            data-placement="top" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $s->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Siswa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="POST"
                                                    action="{{ route('siswa.update', $s->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <input type="text" name="name" placeholder="Nama Lengkap"
                                                            class="form-control" value="{{ $s->nama }}" required>
                                                        <br>
                                                        <input type="text" name="placeOfBirth" placeholder="Tempat Lahir"
                                                            class="form-control" value="{{ $s->tempat_lahir }}" required>
                                                        <br>
                                                        <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir"
                                                            class="form-control"
                                                            value="{{ $s->tanggal_lahir }}" required>
                                                        <br>
                                                        <select name="jenis_kelamin" class="form-control" required>
                                                            <option value="L" {{ $s->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                                Laki-Laki</option>
                                                            <option value="P" {{ $s->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                                Perempuan</option>
                                                        </select>
                                                        <br>
                                                        <input type="text" name="address" placeholder="Alamat"
                                                            class="form-control" value="{{ $s->alamat }}" required>
                                                        <br>
                                                        <input type="number" name="class" placeholder="Kelas"
                                                            class="form-control" value="{{ $s->kelas }}" required>
                                                        <br>
                                                        <input type="text" name="prestation" placeholder="Prestasi"
                                                            class="form-control" value="{{ $s->prestasi }}" required>
                                                        <br>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $s->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete Siswa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus siswa {{ $s->nama }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('siswa.destroy', $s->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-center small text-align">
                        <div class="text-muted">Copyright &copy; Afif Maulana Hakim</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Siswa</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <form method="POST" action="{{ route('siswa.store') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="name" placeholder="Nama Lengkap" class="form-control" required>
                        <br>
                        <input type="text" name="placeOfBirth" placeholder="Tempat Lahir" class="form-control" required>
                        <br>
                        <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" class="form-control" required>
                        <br>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <br>
                        <input type="text" name="address" placeholder="Alamat" class="form-control" required>
                        <br>
                        <input type="number" name="class" placeholder="Kelas" class="form-control" required>
                        <br>
                        <input type="text" name="prestation" placeholder="Prestasi" class="form-control" required>
                        <br>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
</body>

</html>
