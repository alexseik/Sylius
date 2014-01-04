////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Inicialización
////////////////////////////////////////////////////////////////////////////////////////////////////////////
CSRF_TOKEN = "ESTONOESUNTOKENSEGURO";
var oldSync = Backbone.sync;
Backbone.sync = function(method, model, options){
  options.beforeSend = function(xhr){
    xhr.setRequestHeader('X-CSRFToken', CSRF_TOKEN);
  };
  return oldSync(method, model, options);
}; 
//variables de los modelos
var total = new Total();
var discount = new Discount();
var customer = new Customer();
var numItem = new NumItem();

//variables de las colecciones
//var noteItems = new NoteItems();

//variables de las vistas
var totalView = new TotalView({model : total});
var discountView = new DiscountView({model : discount});
var customerView = new CustomerView({model : customer});
var numItemView = new NumItemView({model : numItem});


//rejillas
$("#note-grid").append(NoteItemsGrid.render().$el);
$("#variant-grid").append(VariantPageableGrid.render().$el);
$("#customer-grid").append(PageableCustomerGrid.render().$el);

//filtros
$("#variant-grid").prepend(Variant_Sku_Filter.render().$el);
$("#variant-grid").prepend(Variant_Name_Filter.render().$el);

$("#customer-grid").prepend(Customer_Firstname_Filter.render().$el);
$("#customer-grid").prepend(Customer_Lastname_Filter.render().$el);

//paginaciones

$("#customer-grid").append(CustomerPaginator.render().$el);
$("#variant-grid").append(Variant_Paginator.render().$el);



////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Reglas de negocio
////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Regla 1
// Cuando una linea en la rejilla de variantes es clickeada, insertamos un nuevo NoteItem en la rejilla de Note
Backbone.on("variantRowclicked", function (model) {
    var item = new NoteItem({
            "sku":  model.get('sku'),
            "concepto": model.get('name'),
            "price":    model.get('price'),
            "quantity":    1,
            "product_id":  model.get('id'),
            "discount" : 0.0,
            "total":    model.get('price')
    });
    NoteItemsGrid.insertRow([item])
    total.set('total',NoteItemsGrid.collection.total());
    numItem.set('items',NoteItemsGrid.collection.total_items());
});

// Regla2
// Cuando una linea en customers es clickeada, se seleciona setea customer
Backbone.on("customerRowclicked", function (model) {
    
    $('#collapseCustomer').removeClass("in");
    $('#collapseCustomer').addClass("collapse");
    customer.set({'firstname':model.get('firstname'),'lastname':model.get('lastname'),'fiscalid':model.get('fiscalid')});
    
});


//Regla3
//Cuando una linea es editada, se recalcula los totales en la rejilla y en las vistas
NoteItemsGrid.collection.on("backgrid:edited", function(model, column, command){
    if (column.get('name')=== 'quantity' || column.get('name')=== 'price' || column.get('name')=== 'discount'){
        totalParcial = model.get('quantity') * model.get('price');
        nuevoTotal = totalParcial - totalParcial*(model.get('discount')/100);
        
        model.set('total',nuevoTotal);
    }
    total.set('total',NoteItemsGrid.collection.total());
    discount.set('discount',NoteItemsGrid.collection.discount());
    numItem.set('items',NoteItemsGrid.collection.total_items());
});


//Regla 4
//Cuando una linea es borrada se recalculan los totales
Backbone.on("deleteRowclicked", function (model) {
    total.set('total',NoteItemsGrid.collection.total());
    discount.set('discount',NoteItemsGrid.collection.discount());
    numItem.set('items',NoteItemsGrid.collection.total_items());
});


$( document ).ready(function() {
// Handler for .ready() called.

    //Regla 5
    //Cremos una nueva linea por defecto.
    $('#new_item_button').click(function(){
        var item = new NoteItem({
                "sku":  999,
                "concepto": 'indefinido',
                "price":    0.0,
                "quantity":    1,
                "product_id":  999,
                "discount" : 0.0,
                "total":    0.0
        });
        NoteItemsGrid.insertRow([item]);
        total.set('total',NoteItemsGrid.collection.total());
        numItem.set('items',NoteItemsGrid.collection.total_items());
    });
    
    //Regla 6 
    //Salvamos la rejilla
    $('#new_save_button').click(function(){
        //noteItemsGrid.collection.sync('create',noteItemsGrid.collection.models);
        
//        models = NoteItemsGrid.collection.models;
        
//        models.forEach(function(model){
//            
//            model.save();
//        });

          NoteItemsGrid.collection.save();
    });
    
    var note = new Note()
    note.fetch();
    
 
});

