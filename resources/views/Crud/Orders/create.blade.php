@extends('layouts.app')
@foreach ($drink as $item)
                    <div class="col-sm-5 m-2">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">{{$item->name}} 
                            @if ($item->status == 'ready')
                              <div class="badge badge-success">
                                  {{$item->status}}
                              </div>                     
                            @else
                              <div class="badge badge-secondary">
                                      {{$item->status}}
                              </div>
                            @endif
                          </h5>
                          
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                          <p>Rp. {{$item->price}} ,-</p>
                              @if ($item->status == 'not_ready')
                              <button type="button" href="#" class="btn btn-secondary" disabled>Order</button>

                              @else
                                  
                              <button href="#" class="btn btn-primary Order" id="addToCart" 
                              data-id="{{ $item->id }}" 
                              data-name="{{ $item->name }}"
                              data-price="{{ $item->price }}">Order</button>
                              @endif
                        </div>
                      </div>
                    </div>
                @endforeach
                