@extends('layout.app')

@section('content')

<div class="row">    
    <div class="col-12">
        <div class="content-wrapper border">
            <section class="section-products">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-8 col-lg-6">
                            <div class="header">
                                <h2>{{ $title }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">          
                        <div class="col-12 mb-4">                            
                            <div class="container">                                    
                                <div class="example-wrapper">
                                    {{ $list }}
                                </div>
                                <div class="updated-example-wrapper" id="list_element"></div>
                                                              
                            </div>                           
                        </div>       
                        <hr>
                        <div class="col-12">
                             <div class="btn-wrapper">
                                <button type="button" class="btn btn-primary btn-put">Put</button>
                                <button type="button" class="btn btn-warning btn-patch">Patch</button>
                                <button type="button" class="btn btn-danger btn-delete">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnPut = document.querySelectorAll('.btn-put');
        const btnPatch = document.querySelectorAll('.btn-patch');
        const btnDelete = document.querySelectorAll('.btn-delete');   

        btnPut.forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();         
                
                const number = 1 + Math.floor(Math.random() * 6);

                window.axios.put('{{route('example.add')}}', {
                  item: number
                }).then(response => {
                    document.getElementById('list_element').innerHTML = response.data.list + '<div class="alert alert-success mt-3" role="alert">' + response.data.msg + '</div>';
                }).catch(error => {
                    console.log(error);
                });                
            });
        });

        btnPatch.forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();         
                
                const number = 1 + Math.floor(Math.random() * 6);

                window.axios.patch('{{route('example.update')}}', {
                    item: number,
                    key: 1
                }).then(response => {
                    document.getElementById('list_element').innerHTML = response.data.list + '<div class="alert alert-warning mt-3" role="alert">' + response.data.msg + '</div>';
                }).catch(error => {
                    console.log(error);
                });                
            });
        });

        btnDelete.forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();         
                
                const number = 1 + Math.floor(Math.random() * 6);

                window.axios.delete('{{route('example.remove')}}', {                  
                    data: {id: number}
                }).then(response => {
                    document.getElementById('list_element').innerHTML = response.data.list + '<div class="alert alert-danger mt-3" role="alert">' + response.data.msg + '</div>';
                }).catch(error => {
                    console.log(error);
                });                
            });
        });
    });
</script>
@endpush

@push('style')
<style>    
</style>
@endpush