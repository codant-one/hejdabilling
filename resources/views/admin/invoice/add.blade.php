@extends('admin.layouts.master')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row invoice-add">
                <!-- Invoice Add-->
                <div class="col-lg-9 col-12 mb-lg-0 mb-4">
                  <div class="card invoice-preview-card">
                    <div class="card-body">
                      <div class="row m-sm-4 m-0">
                        <div class="col-md-7 mb-md-0 mb-4 ps-0">
                          <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                            @if($company->logo)
                            <img src="{{asset('storage/'.$company->logo) }}" alt="Company logo" width="70">
                            @else
                            <img src="{{ asset('assets/img/illustrations/icon-login-hejdabilling.png') }}" alt="logo" width="50">
                            @endif
                            <span class="app-brand-text fw-bold fs-4"> {{$company->name}} </span>
                          </div>
                          <p class="mb-2">{{$company->address}}</p>
                          <p class="mb-2">{{$company->country->name}}</p>
                          <p class="mb-3">{{$company->phone}}</p>
                        </div>
                        <div class="col-md-5">
                          <dl class="row mb-2">
                            <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                              <span class="h4 text-capitalize mb-0 text-nowrap">Invoice</span>
                            </dt>
                          
                            <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                              <div class="input-group input-group-merge disabled w-px-150">
                                <span class="input-group-text">#</span>
                                <input
                                  type="text"
                                  class="form-control"
                                  disabled
                                  placeholder="cant_invoice"
                                  value="{{$cant_invoice+1}}"
                                  id="invoiceId"
                                />
                              </div>
                            </dd>
                          
                            <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                              <span class="fw-normal">Date:</span>
                            </dt>
                            <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                              <input type="text" name="date_a" id="date_a" class="form-control w-px-150 date-picker" placeholder="YYYY-MM-DD" value="{{ date('Y-m-d') }}"/>
                            </dd>
                            <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                              <span class="fw-normal">Due Date:</span>
                            </dt>
                            @php
                                $fechaActual = date('Y-m-d');
                                $fechaSumada = date('Y-m-d', strtotime($fechaActual . ' +2 weeks'));
                            @endphp
                            <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                              <input type="text" name="due_date" id="due_date" class="form-control w-px-150 date-picker" placeholder="YYYY-MM-DD" value="{{$fechaSumada}}" />
                            </dd>
                          </dl>
                        </div>
                      </div>

                      <hr class="my-3 mx-n4" />

                      <div class="row p-sm-4 p-0">
                        <div class="col-md-6 col-sm-5 col-12 mb-sm-0 mb-4">
                          <h6 class="mb-4">Invoice To:</h6>
                          <p class="mb-1">{{$client->name}} {{$client->lastname}}</p>
                          <p class="mb-1">{{$client->name_company}}</p>
                          <p class="mb-1">{{$client->address}}</p>
                          <p class="mb-1">{{$client->phone}}</p>
                          <p class="mb-0">{{$client->email}}</p>
                        </div>
                        <div class="col-md-6 col-sm-7">
                          <h6 class="mb-4">Bill To:</h6>
                          <table>
                            @foreach($company->payment_method as $payment)
                              <tbody>
                                <tr>
                                  <td class="pe-4">Total Due:</td>
                                  <td><strong id="todaldue">00.00</strong></td>
                                </tr>
                                <tr>
                                  <td class="pe-4">Bank name:</td>
                                  <td>{{$payment->name_bank}}</td>
                                </tr>
                                <tr>
                                  <td class="pe-4">Country:</td>
                                  <td>{{$company->country->name}}</td>
                                </tr>
                                <tr>
                                  <td class="pe-4">IBAN:</td>
                                  <td>{{$payment->iban}}</td>
                                </tr>
                                <tr>
                                  <td class="pe-4">SWIFT code:</td>
                                  <td>{{$payment->swish}}</td>
                                </tr>
                              </tbody>
                            @endforeach
                          </table>
                        </div>
                      </div>

                      <hr class="my-3 mx-n4" />
                      
                      <form class="pt-4 px-0 px-sm-4" id="formularioFactura" action="{{route('invoice.generate',$client->id)}}" method="POST">
                        <div class="mb-3" id="newitems">
                          <div class="repeater-wrapper pt-0 pt-md-4 item" id="item1">
                            <div class="d-flex border rounded position-relative pe-0">
                              <div class="row w-100 p-3">
                                <div class="col-md-6 col-12 mb-md-0 mb-3" id="newdetails">
                                  <p class="mb-2 repeater-title">Item</p>
                                  <input type="text" class="form-control" name="item-details[]" placeholder="Item details"/>
                                  <!--<textarea class="form-control" rows="2" placeholder="Item Information"></textarea>-->
                                 <!--<br> <button type="button" onclick="add_input()" class="btn btn-primary">Add input</button>-->
                                </div>
                                <div class="col-md-3 col-12 mb-md-0 mb-3">
                                  <p class="mb-2 repeater-title">Cost</p>
                                  <input
                                    type="number"
                                    class="form-control invoice-item-price mb-3"
                                    placeholder="00"
                                    min="12"
                                    name="cost[]"
                                  />
                                </div>
                                <div class="col-md-2 col-12 mb-md-0 mb-3">
                                  <p class="mb-2 repeater-title">Qty</p>
                                  <input
                                    type="number"
                                    class="form-control invoice-item-qty"
                                    placeholder="1"
                                    min="1"
                                    max="50"
                                    name="qty[]"
                                  />
                                </div>
                                <div class="col-md-1 col-12 pe-0">
                                  <p class="mb-2 repeater-title">Price</p>
                                  <p class="mb-0" name="price" id="price[]"></p>
                                </div>
                              </div>
                              <div
                                class="d-flex flex-column align-items-center justify-content-between border-start p-2"
                              >
                                <i class="ti ti-x cursor-pointer eliminar_item" data-repeater-delete id="eliminar1"></i> 
                                <div class="dropdown">
                                  <i
                                    class="ti ti-settings ti-xs cursor-pointer more-options-dropdown"
                                    role="button"
                                    id="dropdownMenuButton"
                                    data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside"
                                    aria-expanded="false"
                                  >
                                  </i>
                                  <div
                                    class="dropdown-menu dropdown-menu-end w-px-300 p-3"
                                    aria-labelledby="dropdownMenuButton"
                                  >
                                    <div class="row g-3">
                                      <div class="col-12">
                                        <label for="discountInput" class="form-label">Discount(%)</label>
                                        <input
                                          type="number"
                                          class="form-control"
                                          id="discountInput"
                                          min="0"
                                          max="100"
                                        />
                                      </div>
                                      <div class="col-md-6">
                                        <label for="taxInput1" class="form-label">Tax 1</label>
                                        <select name="tax-1-input" id="taxInput1" class="form-select tax-select">
                                          <option value="0%" selected>0%</option>
                                          <option value="1%">1%</option>
                                          <option value="10%">10%</option>
                                          <option value="18%">18%</option>
                                          <option value="40%">40%</option>
                                        </select>
                                      </div>
                                      <div class="col-md-6">
                                        <label for="taxInput2" class="form-label">Tax 2</label>
                                        <select name="tax-2-input" id="taxInput2" class="form-select tax-select">
                                          <option value="0%" selected>0%</option>
                                          <option value="1%">1%</option>
                                          <option value="10%">10%</option>
                                          <option value="18%">18%</option>
                                          <option value="40%">40%</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="dropdown-divider my-3"></div>
                                    <button type="button" class="btn btn-label-primary btn-apply-changes">Apply</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row pb-4">
                          <div class="col-12">
                            <button type="button" onclick="add_item()" class="btn btn-primary">Add Item</button>
                          </div>
                        </div>
                   

                      <hr class="my-3 mx-n4" />

                      <div class="row p-0 p-sm-4">
                        <div class="col-md-6 mb-md-0 mb-3">
                          <div class="d-flex align-items-center mb-3">
                            <label for="salesperson" class="form-label me-4 fw-semibold">Salesperson:</label>
                            <input
                              type="text"
                              class="form-control ms-3"
                              id="salesperson"
                              placeholder="Edward Crowley"
                            />
                          </div>
                          <input
                            type="text"
                            class="form-control"
                            id="invoiceMsg"
                            placeholder="Thanks for your business"
                          />
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                          <div class="invoice-calculations">
                            <div class="d-flex justify-content-between mb-2">
                              <span class="w-px-100">Subtotal:</span>
                              <span class="fw-semibold" id="subtotal">00.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                              <span class="w-px-100">Discount:</span>
                              <span class="fw-semibold">00.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                              <span class="w-px-100">Tax:</span>
                              <span class="fw-semibold">00.00</span>
                            </div>
                            <hr />
                            <div class="d-flex justify-content-between">
                              <span class="w-px-100">Total:</span>
                              <span class="fw-semibold" id="total">00.00</span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <hr class="my-3 mx-n4" />

                      <div class="row px-0 px-sm-4">
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="note" class="form-label fw-semibold">Note:</label>
                            <textarea class="form-control" rows="2" id="note" placeholder="Invoice note"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                
                <!-- /Invoice Add-->

                <!-- Invoice Actions -->
                <div class="col-lg-3 col-12">
                  <div class="card mb-4">
                    <div class="card-body">
                      <p class="mb-2">Select Currency</p>
                      <select  class="form-select mb-4" name="typecurrency"  id="typecurrency">
                        @foreach($currencies as $currency)
                        <option value="{{$currency->id}}">{{$currency->code}}</option>
                        @endforeach
                      </select>
                      <input type="hidden" name="date_hidden" id="date_hidden" value="{{ date('Y-m-d') }}" />
                      <input type="hidden" name="duedate_hidden" id="duedate_hidden" value="{{$fechaSumada}}" />

                      <small class="text-light fw-semibold d-block">Payment Method</small>
                        <div class="form-check form-check-inline mt-3">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="mode_payment"
                            id="inlineRadio1"
                            value="FAKTURA"
                          />
                          <label class="form-check-label" for="inlineRadio1">Transfer or Swish</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="mode_payment"
                            id="inlineRadio2"
                            value="KONTANTFAKTURA"
                          />
                          <label class="form-check-label" for="inlineRadio2">Cash</label>
                        </div>
                        <br> <br> 
                      @csrf
                      <button
                        type="submit"
                        class="btn btn-primary d-grid w-100 mb-2"
                      >
                       Create invoice
                      </button>
             
                      <!--<a href="./app-invoice-preview.html" class="btn btn-label-secondary d-grid w-100 mb-2">Preview</a>
                      <button type="button" class="btn btn-label-secondary d-grid w-100">Save</button>-->
                    </div>
                  </div>
                  <div>
              </form>   
              </div>
              <button  class="btn btn-primary d-grid w-100 mb-2" onclick="window.location.href='{{route('invoice.client')}}';">Return list Clients</button>
              <!-- Offcanvas -->

              <!-- /Offcanvas -->
            </div>
            <!-- / Content -->

@endsection

@section('scripts')
<script>
var contadorClones = 2;
/*
function add_input()
{

  // Obtén el formulario y el campo de entrada original
  var formulario = document.getElementById('formularioFactura');
  var campoOriginal = formulario.querySelector('input[name="item-details[]"]');
  if (campoOriginal) {
    // Clona el campo original
    var nuevoCampo = campoOriginal.cloneNode(true);
    
    // Cambia el valor del atributo "name" en el campo duplicado
    nuevoCampo.setAttribute('name', 'item-details[]'+'input[]');
    
    // Limpia el valor del campo duplicado (opcional)
    nuevoCampo.value = '';
    
    // Agrega el nuevo campo al formulario
    $('#newdetails').append(nuevoCampo);
  }

}*/
function add_item()
{
        var aux = contadorClones;
        var item = $(this).closest(".item");
        // Clonar el grupo de campos del primer item
        var newItem = $(".item:first").clone();

        // Limpiar los valores del nuevo item
        newItem.find('input').val('');
        // Insertar el nuevo item clonado después del elemento original
        newItem.insertAfter(item);
        newItem.attr('id', 'item'+contadorClones);



        // Mover el elemento clonado al final del formulario
        $("#newitems").append(newItem);

        var seccionOriginal = $('#item'+contadorClones+' .eliminar_item'); // Obtener la primera sección original

        seccionOriginal.attr('id', 'eliminar'+contadorClones); // Asignar un ID único
  

        $('#eliminar'+aux).click(function() {
          $('#item'+aux).remove(); // Elimina el elemento con ID "eliminar2"
          recalcular();
        });

        contadorClones++;

      
        ///Recorrido de names

        // Seleccionar todos los elementos con el atributo "name" igual a "cost[]"
          var costInputs = $('input[name="cost[]"]');
          var qtyInputs = $('input[name="qty[]"]');
          var costos =[];
          var qtys = [];
          var subtotales = 0;
          var iterador = 0;
          // Iterar a través de los elementos y obtener sus valores
          costInputs.each(function(index) {
            costos[iterador] = $(this).val(); // Obtener el valor del input actual
            iterador = iterador + 1;
          });
          iterador = 0;
          qtyInputs.each(function(index) {
            qtys[iterador] = $(this).val(); // Obtener el valor del input actual
            iterador = iterador + 1;
          });

          for (let index = 0; index < costos.length; index++) 
          {
            var price = costos[index] * qtys[index];
            console.log("el precio es: "+ price);
            $('p[id="price[]"]').eq(index).text(price);

            subtotales += price;
            $("#subtotal").text(subtotales);
            $("#total").text(subtotales);
            $("#todaldue").text(subtotales);
          }
          



        ///fin recorrido names
    
  var valores = {};

        // Seleccionar los elementos cuyo atributo name comienza con "miCampo[".
        $('input[name^="group-a["]').each(function () {
            var name = $(this).attr("name");
            var matches = name.match(/\[(\d+)\]\[([^\]]+)\]/);
            var indice = parseInt(matches[1]);
            var propiedad = matches[2];

            if (!valores[indice]) {
                valores[indice] = {};
            }

            valores[indice][propiedad] = $(this).val();
            
        });

        // Haz algo con los valores, como mostrarlos en la consola.
        console.log("Valores de los campos de entrada:");
        console.log(valores);

        var subtotal =0;
        Object.keys(valores).forEach(function(key) {
            console.log(key + ": " + valores[key].cost);
            console.log(key + ": " + valores[key].qty);
            var price = valores[key].cost * valores[key].qty;
            console.log(price);
            
            $('p[id="price[]"]').eq(key).text(price);
            
            subtotal += price; 
            $("#subtotal").text(subtotal);
            $("#total").text(subtotal);
            $("#todaldue").text(subtotal);
        });
         
}

function recalcular()
{

  // Seleccionar todos los elementos con el atributo "name" igual a "cost[]"
  var costInputs = $('input[name="cost[]"]');
          var qtyInputs = $('input[name="qty[]"]');
          var costos =[];
          var qtys = [];
          var subtotales = 0;
          var iterador = 0;
          // Iterar a través de los elementos y obtener sus valores
          costInputs.each(function(index) {
            costos[iterador] = $(this).val(); // Obtener el valor del input actual
            iterador = iterador + 1;
          });
          iterador = 0;
          qtyInputs.each(function(index) {
            qtys[iterador] = $(this).val(); // Obtener el valor del input actual
            iterador = iterador + 1;
          });

          for (let index = 0; index < costos.length; index++) 
          {
            var price = costos[index] * qtys[index];
            console.log("el precio es: "+ price);
            $('p[id="price[]"]').eq(index).text(price);

            subtotales += price;
            $("#subtotal").text(subtotales);
            $("#total").text(subtotales);
            $("#todaldue").text(subtotales);
          }
          



        ///fin recorrido names
    
  var valores = {};

        // Seleccionar los elementos cuyo atributo name comienza con "miCampo[".
        $('input[name^="group-a["]').each(function () {
            var name = $(this).attr("name");
            var matches = name.match(/\[(\d+)\]\[([^\]]+)\]/);
            var indice = parseInt(matches[1]);
            var propiedad = matches[2];

            if (!valores[indice]) {
                valores[indice] = {};
            }

            valores[indice][propiedad] = $(this).val();
            
        });

        // Haz algo con los valores, como mostrarlos en la consola.
        console.log("Valores de los campos de entrada:");
        console.log(valores);

        var subtotal =0;
        Object.keys(valores).forEach(function(key) {
            console.log(key + ": " + valores[key].cost);
            console.log(key + ": " + valores[key].qty);
            var price = valores[key].cost * valores[key].qty;
            console.log(price);
            
            $('p[id="price[]"]').eq(key).text(price);
            
            subtotal += price; 
            $("#subtotal").text(subtotal);
            $("#total").text(subtotal);
            $("#todaldue").text(subtotal);
        });
        

}


      //Capturamos la fecha en los inputs ocultos del formulario.
      
      $('#date_a').on('change', function () {
        
            $('#date_hidden').val($(this).val());
        });

        $('#due_date').on('change', function () {
        
            $('#duedate_hidden').val($(this).val());
        });





</script>

@endsection