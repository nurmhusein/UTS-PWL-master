<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS PWL 2022</title>
    
    {{-- <link rel="icon" type="image/png" href="./Logo ITERA.png" sizes="32x32"> --}}

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="w-full min-h-screen bg-white">

        <!-- MEMILIH SEMESTER -->
        <div class="w-2/3 m-auto flex text-sm font-medium justify-center py-6">
            <label class="py-1 mr-3" for="semester_select">Semester</label>
            <select class="w-5/6 px-1 border border-gray-500" name="semester_select" id="semester_select" onchange="ambil_data()">
                @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}">{{ $semester->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-2/3 m-auto drop-shadow-lg shadow-slate-200">
            <!-- MEMILIH JENIS MATA KULIAH -->
            <div class="w-full font-medium m-auto flex justify-start pt-4 pb-2 px-4 bg-purple-50">
                <div class="mr-4">
                    <input onchange="ambil_data()" type="radio" id="prodi" name="isProdi" value="prodi" checked>
                    <label class="text-base" for="prodi">Mata Kuliah Prodi</label>
                </div>
                <div class="mr-4">
                    <input onchange="ambil_data()" type="radio" id="bukanprodi" name="isProdi" value="bukanprodi">
                    <label class="text-base" for="bukanprodi">Mata Kuliah Luar Prodi</label>
                </div>
            </div>
            <div class="w-full font-medium m-auto flex justify-between p-4 bg-purple-50">
                <!-- MEMILIH LIMIT PAGE-->
                <div class="flex" id="selectLimitArea">
                    <p class="block">Tampil </p>
                    <select class="mx-3 px-1" name="limit_select" id="limit_select" onchange="ambil_data()">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <p class="block">data</p>
                </div>
                <!-- MENCARI DATA -->
                <div class="flex justify-end">
                    <label for="search">Cari</label>
                    <input class="ml-3" type="text" name="" id="search" onkeyup="Cari_Data()">
                </div>
            </div>
            <div class="w-full p-4 border-y-2 border-purple-600 bg-purple-50         min-h-[140px]">
                <table class="border-collapse w-full border-b-2 border-gray-500" id="datatable">
                    <tr class="bg-purple-200 text-black-500 border-b-2 border-gray-500">
                        <th class="py-1 ">No</th>
                        <th class="py-1 ">Kode Kelas</th>
                        <th class="py-1 ">Nama Kelas</th>
                        <th class="py-1 ">Kode Matakuliah</th>
                        <th class="py-1 ">Nama Matakuliah</th>
                        <th class="py-1 ">SKS</th>
                        <th class="py-1 ">Aksi</th>
                    </tr>
                    {{-- {{ $kelas->count() }} --}}
                    @foreach ($kelas as $kls)
                        <tr class="text-black-600 border-b border-purple-300">
                            <td class="{{ $loop->index % 2 == 0 ? 'bg-purple-100' : '' }} py-1 text-center">{{ $loop->index+1 }}</td>
                            <td class="{{ $loop->index % 2 == 0 ? 'bg-purple-100' : '' }} py-1 text-center">{{ $kls->kode }}</td>
                            <td class="{{ $loop->index % 2 == 0 ? 'bg-purple-100' : '' }} py-1 text-center">{{ $kls->nama }}</td>
                            <td class="{{ $loop->index % 2 == 0 ? 'bg-purple-100' : '' }} py-1 text-center">{{ $kls->matakuliah->kode }}</td>
                            <td class="{{ $loop->index % 2 == 0 ? 'bg-purple-100' : '' }} py-1 text-center">{{ $kls->matakuliah->nama }}</td>
                            <td class="{{ $loop->index % 2 == 0 ? 'bg-purple-100' : '' }} py-1 text-center">{{ $kls->matakuliah->sks }}</td>
                            <td class="{{ $loop->index % 2 == 0 ? 'bg-purple-100' : '' }} py-1 text-center">
                                <a class="flex py-1 px-2 pr-3 w-fit m-auto rounded bg-purple-500 text-gray-100 text-xs font-light hover:bg-purple-600 hover:text-white" href="{{ route('detail', [$kls->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="w-full font-medium m-auto flex justify-between p-4 bg-purple-50" id="bottomMenuArea">
                <div>
                    Menampilkan <span id="mulai_ditampilkan"> 1 </span> - <span id="akhir_ditampilkan"> 10 </span> dari <span id="jumlah_semua_data"> {{ $kelas_count }} </span> data 
                </div>
                <div class="flex justify-end" id="pagination" value="">
                    <a onclick="select_page(1)" class="py-1 px-3 border cursor-pointer hover:bg-purple-200 bg-purple-300 ">1</a>
                    <a onclick="select_page(2)" class="py-1 px-3 border cursor-pointer hover:bg-purple-200">2</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript">

        function select_page(page){
            document.getElementById("pagination").value = page;
            ambil_data();
        }

        async function Cari_Data(){
            // Text Input untuk menangkap nilai keyword
            const keyword               = document.getElementById("search").value;
            // Select Option 'Limit'
            const selectLimitArea       = document.getElementById("selectLimitArea");
            // BottomMenuArea
            const bottomMenuArea        = document.getElementById("bottomMenuArea");
            // Tabel Utama
            const datatable             = document.getElementById("datatable");
            
            const semester              = document.getElementById("semester_select");
            const isProdi               = document.getElementById("prodi");
            
            if(isProdi.checked==true){
                selected_type           = "1";
            }else{
                selected_type           = "0";
            }
            let selected_semester       = semester.value;
            console.log(keyword);
            console.log(selected_semester);
            console.log(selected_type);
            if(keyword != ""){
                selectLimitArea.classList.add("hidden");
                bottomMenuArea.classList.add("hidden");
                let URL                     = 'search/' + keyword + '/' + selected_semester + '/' + selected_type;
                let ResResult               = await fetch(URL, { method : 'get' });
                let Result                  = await ResResult.json();
                console.log(Result);
                if(Result.length < 1){
                    datatable.innerHTML         = "";
                    datatable.innerHTML        += "<h1 class=\"block text-2xl p-3 font-bold text-center text-gray-500\">Data tidak ditemukan</h1>"     
                }else{
                    datatable.innerHTML         = "";
                    datatable.innerHTML        += "" 
                        +"<tr class=\"bg-purple-200 text-gray-500 border-b-2 border-gray-500\">"
                            +"<th class=\"py-1 \">No</th>"
                            +"<th class=\"py-1 \">Kode Kelas</th>"
                            +"<th class=\"py-1 \">Nama Kelas</th>"
                            +"<th class=\"py-1 \">Kode Mata Kuliah</th>"
                            +"<th class=\"py-1 \">Nama Mata Kuliah</th>"
                            +"<th class=\"py-1 \">SKS</th>"
                            +"<th class=\"py-1 \">Aksi</th>"
                        +"</tr>";
                    for (let i=0; i<Result.length; i++){
                        if (i % 2 == 0){
                            datatable.innerHTML += ""
                                +"<tr class=\"text-gray-600 border-b border-purple-300\">"
                                    +"<td class=\"bg-white py-1 text-center\">" + (i+1) + "</td>"
                                    +"<td class=\"bg-white py-1 text-center\">" + Result[i]['kode'] + "</td>"
                                    +"<td class=\"bg-white py-1 text-center\">" + Result[i]['nama'] + "</td>"
                                    +"<td class=\"bg-white py-1 text-center\">" + Result[i]['matakuliah']['kode'] + "</td>"
                                    +"<td class=\"bg-white py-1 \">" + Result[i]['matakuliah']['nama'] + "</td>"
                                    +"<td class=\"bg-white py-1 text-center\">" + Result[i]['matakuliah']['sks'] + "</td>"
                                    +"<td class=\"bg-white py-1 text-center\">"
                                        +"<a class=\"flex py-1 px-2 pr-3 w-fit m-auto rounded bg-purple-500 text-gray-100 text-xs font-light hover:bg-purple-600 hover:text-white\" href=\"detail/"+Result[i]['id']+"\">"
                                            +"<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-4 w-4 mr-2\" viewBox=\"0 0 20 20\" fill=\"currentColor\">"
                                                +"<path d=\"M10 12a2 2 0 100-4 2 2 0 000 4z\"/>"
                                                +"<path fill-rule=\"evenodd\" d=\"M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z\" clip-rule=\"evenodd\"/>"
                                            +"</svg>"
                                            +"Lihat"
                                        +"</a>"
                                    +"</td>"
                                +"</tr>";
                        }else{
                            datatable.innerHTML += ""
                                +"<tr class=\"text-gray-600 border-b border-purple-300\">"
                                    +"<td class=\"py-1 text-center\">" + (i+1) + "</td>"
                                    +"<td class=\"py-1 text-center\">" + Result[i]['kode'] + "</td>"
                                    +"<td class=\"py-1 text-center\">" + Result[i]['nama'] + "</td>"
                                    +"<td class=\"py-1 text-center\">" + Result[i]['matakuliah']['kode'] + "</td>"
                                    +"<td class=\"py-1 \">" + Result[i]['matakuliah']['nama'] + "</td>"
                                    +"<td class=\"py-1 text-center\">" + Result[i]['matakuliah']['sks'] + "</td>"
                                    +"<td class=\"py-1 text-center\">"
                                        +"<a class=\"flex py-1 px-2 pr-3 w-fit m-auto rounded bg-purple-500 text-gray-100 text-xs font-light hover:bg-purple-600 hover:text-white\" href=\"detail/"+Result[i]['id']+"\">"
                                            +"<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-4 w-4 mr-2\" viewBox=\"0 0 20 20\" fill=\"currentColor\">"
                                                +"<path d=\"M10 12a2 2 0 100-4 2 2 0 000 4z\"/>"
                                                +"<path fill-rule=\"evenodd\" d=\"M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z\" clip-rule=\"evenodd\"/>"
                                            +"</svg>"
                                            +"Lihat"
                                        +"</a>"
                                    +"</td>"
                                +"</tr>";
                        }
                    }
                }
            }else{
                selectLimitArea.classList.remove("hidden");
                bottomMenuArea.classList.remove("hidden");
                datatable.innerHTML         = '';
                get_Data();
            }
        }


        async function ambil_data(){
            // Proses pengambilan elemen penting

            // Select Option 'Semester' dan 'Limit'
            const semester              = document.getElementById("semester_select");
            const limit                 = document.getElementById("limit_select");
            
            // Informasi offset
            const show_start            = document.getElementById("mulai_ditampilkan");
            const show_end              = document.getElementById("akhir_ditampilkan");
            const all_data_count        = document.getElementById("jumlah_semua_data");

            // Tabel Utama
            const datatable             = document.getElementById("datatable");

            // Pagination
            const pagination            = document.getElementById("pagination");

            // IsProdi
            const isProdi               = document.getElementById("prodi");

            if(isProdi.checked==true){
                selected_type = 1;
            }else{
                selected_type = 0;
            }

            if(pagination.value == null){
                pagination.value = 1; 
            }

            // Proses pengambilan JSON menggunakan JS Fetch API
            let selected_semester       = semester.value;
            let selected_limit          = limit.value;
            let selected_page           = pagination.value;

            let URL                     = '/' + selected_semester + '/' + selected_limit + '/' + selected_page + '/' + selected_type;
            let ResResult               = await fetch(URL, { method : 'get' });
            let Result                  = await ResResult.json();

            let jumlah_total_halaman    = Result.links.length-2
            
            // Console Log
            console.log("ID semester dipilih    = "+selected_semester);
            console.log("Limit dipilih          = "+selected_limit);
            console.log("Halaman dipilih        = "+pagination.value)
            console.log("Jumlah total data      = "+Result.total);
            console.log("Jumlah total halaman   = "+jumlah_total_halaman);

            if(isProdi.checked==true){
                console.log("Data dipilih           = Mata Kuliah Prodi");
            }else{
                console.log("Data dipilih           = Mata Kuliah Luar Prodi");
            }
            console.log(Result);

            // Proses Manipulasi Dokumen
            show_start.innerText        = Result.from;
            show_end.innerText          = Result.to;
            all_data_count.innerText    = Result.total;

            datatable.innerHTML         = '';

            datatable.innerHTML        += "" 
                +"<tr class=\"bg-purple-200 text-black-500 border-b-2 border-gray-500\">"
                    +"<th class=\"py-1 \">No</th>"
                    +"<th class=\"py-1 \">Kode Kelas</th>"
                    +"<th class=\"py-1 \">Nama Kelas</th>"
                    +"<th class=\"py-1 \">Kode Matakuliah</th>"
                    +"<th class=\"py-1 \">Nama Matakuliah</th>"
                    +"<th class=\"py-1 \">SKS</th>"
                    +"<th class=\"py-1 \">Aksi</th>"
                +"</tr>";

            for (let i=0; i<Result['data'].length; i++){
                if (i % 2 == 0){
                    datatable.innerHTML += ""
                        +"<tr class=\"text-black-600 border-b border-purple-300\">"
                            +"<td class=\"bg-purple-100 py-1 text-center\">" + (i+Result.from) + "</td>"
                            +"<td class=\"bg-purple-100 py-1 text-center\">" + Result['data'][i]['kode'] + "</td>"
                            +"<td class=\"bg-purple-100 py-1 text-center\">" + Result['data'][i]['nama'] + "</td>"
                            +"<td class=\"bg-purple-100 py-1 text-center\">" + Result['data'][i]['matakuliah']['kode'] + "</td>"
                            +"<td class=\"bg-purple-100 py-1 text-center\">" + Result['data'][i]['matakuliah']['nama'] + "</td>"
                            +"<td class=\"bg-purple-100 py-1 text-center\">" + Result['data'][i]['matakuliah']['sks'] + "</td>"
                            +"<td class=\"bg-purple-100 py-1 text-center\">"
                                +"<a class=\"flex py-1 px-2 pr-3 w-fit m-auto rounded bg-purple-500 text-gray-100 text-xs font-light hover:bg-purple-600 hover:text-white\" href=\"\">"
                                    +"<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-4 w-4 mr-2\" viewBox=\"0 0 20 20\" fill=\"currentColor\">"
                                        +"<path d=\"M10 12a2 2 0 100-4 2 2 0 000 4z\"/>"
                                        +"<path fill-rule=\"evenodd\" d=\"M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z\" clip-rule=\"evenodd\"/>"
                                    +"</svg>"
                                    +"Lihat"
                                +"</a>"
                            +"</td>"
                        +"</tr>";
                }else{
                    datatable.innerHTML += ""
                        +"<tr class=\"text-black-600 border-b border-purple-300\">"
                            +"<td class=\"py-1 text-center\">" + (i+Result.from) + "</td>"
                            +"<td class=\"py-1 text-center\">" + Result['data'][i]['kode'] + "</td>"
                            +"<td class=\"py-1 text-center\">" + Result['data'][i]['nama'] + "</td>"
                            +"<td class=\"py-1 text-center\">" + Result['data'][i]['matakuliah']['kode'] + "</td>"
                            +"<td class=\"py-1 text-center\">" + Result['data'][i]['matakuliah']['nama'] + "</td>"
                            +"<td class=\"py-1 text-center\">" + Result['data'][i]['matakuliah']['sks'] + "</td>"
                            +"<td class=\"py-1 text-center\">"
                                +"<a class=\"flex py-1 px-2 pr-3 w-fit m-auto rounded bg-purple-500 text-gray-100 text-xs font-light hover:bg-purple-600 hover:text-white\" href=\"\">"
                                    +"<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-4 w-4 mr-2\" viewBox=\"0 0 20 20\" fill=\"currentColor\">"
                                        +"<path d=\"M10 12a2 2 0 100-4 2 2 0 000 4z\"/>"
                                        +"<path fill-rule=\"evenodd\" d=\"M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z\" clip-rule=\"evenodd\"/>"
                                    +"</svg>"
                                    +"Lihat"
                                +"</a>"
                            +"</td>"
                        +"</tr>";
                }
            }

            pagination.innerHTML        = "";

            for(let i=1; i<=jumlah_total_halaman; i++){
                pagination.innerHTML       += ""
                    +"<a onclick=\"select_page("+i+")\" class=\"py-1 px-3 border cursor-pointer hover:bg-purple-200 \">"+i+"</a>";
            }

            pagination.value = 1;
        }

    </script>

</body>
</html>
