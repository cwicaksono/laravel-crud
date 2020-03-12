<?php
  
namespace App\Http\Controllers;
  
use App\Produk;
use Illuminate\Http\Request;
  
class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::latest()->paginate(5);
  
        return view('produk.index',compact('produk'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('produk.create');
    }
  
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
  
        Produk::create($request->all());
   
        return redirect()->route('produk.index')
                        ->with('success','Product created successfully.');
    }
   
    public function show(Produk $produk)
    {
        return view('produk.show',compact('produk'));
    }
   
    public function edit(Produk $produk)
    {
        return view('produk.edit',compact('produk'));
    }
  
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
  
        $produk->update($request->all());
  
        return redirect()->route('produk.index')
                        ->with('success','Produk updated successfully');
    }
  
    public function destroy(Produk $produk)
    {
        $produk->delete();
  
        return redirect()->route('produk.index')
                        ->with('success','Produk deleted successfully');
    }
}