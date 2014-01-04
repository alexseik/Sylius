

////////////////////////////////////////////////////////////////////////////////////////////////////////////
// NoteItem
////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Linea de la rejilla en la caja : ticket
 * @type @exp;Backbone@pro;Model@call;extend
 */
NoteItem = Backbone.Model.extend({
    defaults: {
      "sku":  "0",
      "concepto":     "",
      "price":    "00.00",
      "quantity":    0,
      "discount":    0,
      "product_id":  0,
      "total": "00.00",
    },
    urlRoot: '/cash/api/note-item',
    validation:{
        concepto :{
            required:true            
        },
        price :{
            required: true,
            pattern: 'number'
        },
        quantity:{
            required:true,
            pattern: 'digits'
        }
    }
});
/**
 * 
 * La colección de líneas de tickets
 * @type @exp;Backbone@pro;Collection@call;extend
 */
NoteItems = Backbone.Collection.extend({
  model: NoteItem,
  //url: "api/note-item",
  url: function() {
     return noteUrl;
  },
  save: function(){
    Backbone.sync('create', this, {
      success: function() {
        console.log('Saved!');
      }
    });
  },
  total: function(){
        if (!this.length) return 0;
        return this.reduce(function(memo, value) { return memo + value.get("total") }, 0);
  },
  discount: function(){
        if (!this.length) return 0;
        return this.reduce(function(memo, value) { return memo + value.get('price')*value.get('quantity')*((value.get("discount")/100)) }, 0);
  },
  total_items: function(){
        if (!this.length) return 0;
        return this.reduce(function(memo, value) { return memo + value.get('quantity') }, 0);
  }   
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Note
////////////////////////////////////////////////////////////////////////////////////////////////////////////

Note = Backbone.RelationalModel.extend({
    urlRoot: noteUrl,
    relations: [{
		type: Backbone.HasMany,
		key: 'items',
		relatedModel: 'NoteItem',
		collectionType: 'NoteItems',
		reverseRelation: {
			key: 'note',
			includeInJSON: 'id'
			// 'relatedModel' is automatically set to 'Zoo'; the 'relationType' to 'HasOne'.
		}
	}]
});



////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Customers
////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
 * Customer
 * @type @exp;Backbone@pro;Model@call;extend
 */
Customer = Backbone.Model.extend({
    defaults:{'firstname':' ','lastname':' '}
});

/**
 * CustomersPageable
 * @type @exp;Backbone@pro;PageableCollection@call;extend
 */
CustomersPageable = Backbone.PageableCollection.extend({
  model: Customer,
  url: customerUrl,
  state: {
    pageSize: 10
  },
  mode: "client", // page entirely on the client side
  silient: true
});


////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Variant / Product
////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Variant
 * @type @exp;Backbone@pro;Model@call;extend
 */
var Variant = Backbone.Model.extend({});

/**
 * 
 * @type @exp;Backbone@pro;PageableCollection@call;extend
 */
var VariantsPageable = Backbone.PageableCollection.extend({
  model: Variant,
  url: productUrl,
  state: {
    pageSize: 10
  },
  mode: "client", // page entirely on the client side
  silient: true
});


////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Modelos de las vistas extras
////////////////////////////////////////////////////////////////////////////////////////////////////////////
//total en la rejilla
var Total = Backbone.Model.extend({
    defaults:{'total':0.0}
});

//descuento total de la rejilla 
var Discount = Backbone.Model.extend({
    defaults:{'discount':0.0}
});

//numero de productos en la rejilla
var NumItem = Backbone.Model.extend({
    defaults:{'items':0}
});

