@extends('admin.layouts.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <form class="pt-4 px-0 px-sm-4" id="formularioFactura" action="{{route('invoice.store')}}" method="POST">
    <div class="row invoice-add">
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
                  <span class="app-brand-text fw-bold fs-4"> {{ $company->name }} </span>
                </div>
                            
                <p class="mb-2">{{ $company->address }}</p>
                <p class="mb-2">{{ $company->country->name }}</p>
                <p class="mb-3">{{ $company->phone }}</p>
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
                        value="{{ $cant_invoice+1 }}"
                        id="invoiceId"/>
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
                <p class="mb-1" id="client-name"></p>
                <p class="mb-1" id="client-company"></p>
                <p class="mb-1" id="client-org"></p>
                <p class="mb-1" id="client-num"></p>
                <p class="mb-0" id="client-email"></p>
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
                        <td>{{ $payment->name_bank }}</td>
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
            
            <div class="mb-3" id="newitems">
              <div class="repeater-wrapper pt-0 pt-md-4 item" id="item1">
                <div class="d-flex border rounded position-relative pe-0">
                  <div class="row w-100 p-3">
                    <div class="col-md-6 col-12 mb-md-0 mb-3">
                      <p class="mb-2 repeater-title">Item</p>
                      <input type="text" class="form-control" name="item-details[]" placeholder="Item details" required/>
                    </div>
                    <div class="col-md-2 col-12 mb-md-0 mb-3">
                      <p class="mb-2 repeater-title">Cost</p>
                       <input
                        type="text"
                        class="form-control invoice-item-price mb-3"
                        name="cost[]"
                        required/>
                    </div>
                    <div class="col-md-2 col-12 mb-md-0 mb-3">
                      <p class="mb-2 repeater-title">Qty</p>
                      <input
                        type="text"
                        class="form-control invoice-item-qty"
                        placeholder="1"
                        name="qty[]"
                        required/>
                    </div>
                    <div class="col-md-2 col-12 pe-0">
                      <p class="mb-2 repeater-title">Price</p>
                      <p class="mb-0" name="price" id="price[]"></p>
                    </div>
                  </div>
                  <div class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                      <i class="ti ti-x cursor-pointer eliminar_item" data-repeater-delete id="eliminar1"></i>
                      <div class="dropdown">
                        <i
                          class="ti ti-settings ti-xs cursor-pointer more-options-dropdown"
                          role="button"
                          id="dropdownMenuButton"
                          data-bs-toggle="dropdown"
                          data-bs-auto-close="outside"
                          aria-expanded="false">
                        </i>
                        <div class="dropdown-menu dropdown-menu-end w-px-300 p-3" aria-labelledby="dropdownMenuButton">
                          <div class="row g-3">
                            <div class="col-12">
                              <label for="discountInput" class="form-label">Discount(%)</label>
                              <input
                                name="disc[]"
                                type="text"
                                class="form-control invoice-item-price"
                                id="discountInput"
                                min="0"
                                max="100"/>
                            </div>
                            <div class="col-12">
                              <label for="taxInput1" class="form-label">Tax</label>
                              <select name="tax[]" class="form-select">
                                <option value="0" selected>0%</option>
                                <option value="6">6%</option>
                                <option value="12">12%</option>
                                <option value="25">25%</option>
                              </select>
                            </div>
                          </div>
                          <div class="dropdown-divider my-3"></div>
                          <button type="button" class="btn btn-label-primary btn-apply-changes" onclick="apply()">Apply</button>
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
                    placeholder="Edward Crowley"/>
                </div>
                <input
                  type="text"
                  class="form-control"
                  id="invoiceMsg"
                  placeholder="Thanks for your business"/>
              </div>
              <div class="col-md-6 d-flex justify-content-end">
                <div class="invoice-calculations">
                  <div class="d-flex justify-content-between mb-2">
                    <span class="w-px-100">Subtotal:</span>
                    <span class="fw-semibold" id="subtotal">00.00</span>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <span class="w-px-100">Discount:</span>
                    <span class="fw-semibold" id="discount">00.00</span>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <span class="w-px-100">Tax:</span>
                    <span class="fw-semibold" id="taxes">00.00</span>
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
            <input type="hidden" name="id_client" id="id_client" value=""/>
            <p class="mb-2">Select Client</p>
            <select  class="form-select mb-4" name="client-id"  id="client-id" required>
              <option value="">Select</option>
                @foreach($clients as $client)
                  @if($client->name)
                  <option value="{{$client->id}}">{{$client->name}} {{$client->lastname}}</option>
                  @else
                  <option value="{{$client->id}}">{{$client->name_company}}</option>
                  @endif
                @endforeach
            </select>

            <p>Payment method</p>
            <select class="form-select mb-4" name="mode_payment" id="mode_payment" required>
              <option value="">Select</option>
              <option value="FAKTURA">Bank transfer or Swish</option>
              <option value="KONTANTFAKTURA">Cash</option>
            </select>
            @csrf
            <button type="submit" class="btn btn-primary d-grid w-100 mb-2"> Create invoice </button>
          </div>
        </div>         
      <div>         
  
    </div>
  </form>
  <button  class="btn btn-primary d-grid w-100 mb-2" onclick="window.location.href='{{route('invoice.client')}}';">Return list Clients</button>      
</div>
@endsection

@section('scripts')
<script>

  var contadorClones = 2;

  //Capturamos la fecha en los inputs ocultos del formulario.
  $('#date_a').on('change', function () {
    $('#date_hidden').val($(this).val());
  });

  $('#due_date').on('change', function () {
    $('#duedate_hidden').val($(this).val());
  });

  $('#client-id') .on('change', function(){
    // Obtiene el valor seleccionado
    var client_id = $(this).val();
    var route = "{{ route('invoice.get_client', ['id' => 'id-here']) }}"
    $.ajax({
      type: "GET",
      url: route.replaceAll('id-here', client_id), // Reemplaza 'ruta.ajax' con la ruta correcta en tu aplicación
      success: function(response) {
        // Actualiza la parte de la plantilla con la respuesta del servidor
        //$("#resultado").html(response);
        if(response.client.name === null) {
          $('#client-company').text(response.client.name_company);
          $('#client-org').text(response.client.org_num);
          $('#client-name').text(""); 
        } else {
          $('#client-name').text(response.client.name + " " + response.client.lastname);
          $('#client-company').text("");
          $('#client-org').text("");
        }

        $('#client-num').text(response.client.phone);
        $('#client-email').text(response.client.email);
        $('#id_client').val(response.client.id);
                
      }
    });

  })

function apply(){
 ///Recorrido de names

  // Seleccionar todos los elementos con el atributo "name" igual a "cost[]"
  var costInputs = $('input[name="cost[]"]');
  var qtyInputs = $('input[name="qty[]"]');
  var taxInputs = $('select[name="tax[]"]');
  var discInputs = $('input[name="disc[]"]');
  var costos =[];
  var qtys = [];
  var tax = [];
  var disc = []; 
  var subtotales = 0;
  var discountTotal = 0;
  var taxTotal = 0;
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
      
  iterador = 0;
  taxInputs.each(function(index) {
    tax[iterador] = $(this).val(); // Obtener el valor del input actual
    iterador = iterador + 1;
  });

  iterador = 0;
  discInputs.each(function(index) {
    disc[iterador] = $(this).val(); // Obtener el valor del input actual
    iterador = iterador + 1;
  });
            
  for (let index = 0; index < costos.length; index++) {
    var price = costos[index] * qtys[index];
    var taxes = price * tax[index] * 0.01;
    var discount = price * disc[index] * 0.01;
    var priceTotal = price + taxes - discount;
    

    console.log("el precio es: "+ priceTotal);
    console.log("los impuestos son: "+ taxes);
    console.log("El descuento es: "+ discount);  

    $('p[id="price[]"]').eq(index).text(priceTotal);

    subtotales += price;
    discountTotal += discount;
    taxTotal += taxes;

    var total = subtotales + taxTotal - discountTotal;

    $("#subtotal").text(subtotales);
    $("#total").text(total);
    $("#todaldue").text(total);
    $("#discount").text(discountTotal);
    $("#taxes").text(taxTotal);
   }

}

function add_item() {

  var aux = contadorClones;
  var item = $(this).closest(".item");
  var newItem = $(".item:first").clone();// Clonar el grupo de campos del primer item
        
  // Limpiar los valores del nuevo item
  newItem.find('input').val('');
  newItem.insertAfter(item);
  newItem.attr('id', 'item'+contadorClones);

  // Agregar el nuevo item clonado al formulario
  $("#newitems").append(newItem);

  var seccionOriginal = $('#item'+contadorClones+' .eliminar_item'); // Obtener la primera sección original

  seccionOriginal.attr('id', 'eliminar'+contadorClones); // Asignar un ID único
  
  $('#eliminar'+aux).click(function() {
      $('#item'+aux).remove(); // Elimina el elemento con ID "eliminar2"
      apply();
  });

  contadorClones++;
  apply()
         
}//fin add

</script>
@endsection