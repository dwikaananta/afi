@extends('layouts.main')

@section('content')
    <div id="root"></div>
    <a href="/pengadaan" class="btn btn-sm btn-danger">Kembali</a>
@endsection

@section('js')
    <script type="text/babel">
        const { useState, useEffect } = React;
        // imported

        const Main = (props) => {
            const {tanaman, number, onSendData} = props;

            const [tanamanId, setTanamanId] = useState(Number);
            const [qty, setQty] = useState(0);
            const [harga, setHarga] = useState(0);

            useEffect(() => {
                if (Number(qty) !== 0 && Number(harga) !== 0 && Number(tanamanId) !== 0) {
                    onSendData({
                        tanaman_id: tanamanId,
                        qty: qty,
                        harga_beli: harga,
                        total: Number(qty) * Number(harga),
                    });
                }
            }, [qty, harga, tanamanId]);

            return (
                <tr>
                    <td>{number}</td>
                    <td>
                        <select className="form-select"
                            onChange={e => {
                                // harga
                                setHarga(e.target.value.split('_')[1]);

                                setTanamanId(e.target.value.split('_')[0]);
                            }}
                        >
                            <option value="">Pilih</option>
                            {tanaman.length > 0 && tanaman.map((t,index) => {
                                return (
                                    <React.Fragment key={index}>
                                        <option value={`${t.id}_${t.harga_beli}`}>{t.nama}</option>
                                    </React.Fragment>
                                )
                            })}
                        </select>
                    </td>
                    <td>
                        <input className="form-control" type="number" value={qty}
                            onChange={e => {
                                setQty(e.target.value);
                            }}
                        />
                    </td>
                    <td>
                        <input className="form-control" type="number" value={harga}
                            onChange={e => {
                                setHarga(e.target.value);
                            }}
                        />
                    </td>
                    <td>
                        {Number(qty) * Number(harga)}
                    </td>
                </tr>
            )
        }

        const App = () => {

            // Tanaman
            const [tanaman, setTanaman] = useState([]);

            useEffect(()=>{
                const fetchData = async () => {
                    try {
                        const res = await axios.get('/api/tanaman');
                        if (res.data) {
                            res.data.tanaman && setTanaman(res.data.tanaman);
                        }
                    } catch (err) {
                        console.log(err)
                    }
                }

                fetchData();
            }, []);

            // Supplier
            const [supplier, setSupplier] = useState([]);

            useEffect(()=>{
                const fetchData = async () => {
                    try {
                        const res = await axios.get('/api/supplier');
                        if (res.data) {
                            res.data.supplier && setSupplier(res.data.supplier);
                        }
                    } catch (err) {
                        console.log(err)
                    }
                }

                fetchData();
            }, []);

            const [main, setMain] = useState([1]);
            const [harga, setHarga] = useState([]);

            const [form, setForm] = useState({});

            const [detail, setDetail] = useState({});

            useEffect(() => {
                console.log(form);
                console.log(detail);
            }, [form, detail]);

            const handleSubmit = () => {
                axios.post('/api/pengadaan', {...form, user_id: {{ auth()->user()->id }}, detail: detail})
                    .then(res => {
                        console.log(res.data);
                        if (res.data === 'success') {
                            alert('Berhasil tambah Pengadaaan !');
                            window.location.reload();
                        }
                    })
                    .catch(err => console.log(err))
            }

            const [totalHarga, setTotalHarga] = useState(Number);

            useEffect(() => {
                let a = String(main.filter((m, index) => detail[index] && detail[index]['total']).map((m, index) => {
                    return detail[index]['total'];
                })).split(',');
                
                if (a.length > 0) {
                    let b = a.reduce((total, curr) => Number(total) + Number(curr));

                    setTotalHarga(b);
                }
            }, [detail]);

            return (
                <>
                    <div className="row mb-4">
                        <div className="col-6">
                            <label>Supplier</label>
                            <select
                                name="supplier_id"
                                className="form-select"
                                onChange={e => setForm({...form, [e.target.name]: e.target.value})}
                            >
                                <option value="">Pilih</option>
                                {supplier.length > 0 && supplier.map((s, index) => {
                                    return (
                                        <React.Fragment key={index}>
                                            <option value={s.id}>{s.nama}</option>
                                        </React.Fragment>
                                    )
                                })}
                            </select>
                        </div>
                        <div className="col-6">
                            <label>Tgl Pengadaan</label>
                            <input name="tgl_pengadaan" type="date" className="form-control"
                                onChange={e => setForm({...form, [e.target.name]: e.target.value})}
                            />
                        </div>
                    </div>

                    <table className="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanaman</th>
                                <th>Qty</th>
                                <th>Harga Beli</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            {main.map((m, index)=>{
                                return (
                                    <React.Fragment key={index}>
                                        <Main
                                            tanaman={tanaman}
                                            number={index + 1}
                                            onSendData={resData => setDetail({...detail, [index]: resData})}
                                        />
                                    </React.Fragment>
                                )
                            })}
                        </tbody>
                    </table>

                    <div className="text-end">
                        <h4>Total Bayar : {totalHarga}</h4>
                    </div>


                    <div className="btn-group mb-3 w-100">
                        <button type="button" className="btn btn-sm btn-warning w-100" onClick={() => setMain([...main, 1])}>Tambah</button>
                        <button type="submit" className="btn btn-sm btn-success w-100" onClick={handleSubmit}>Simpan</button>
                    </div>
                </>
            );
        }
        
        ReactDOM.render(<App />, document.getElementById('root'));
    </script>
@endsection
