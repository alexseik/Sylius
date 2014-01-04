
////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Notes
////////////////////////////////////////////////////////////////////////////////////////////////////////////

NoteDeleteCell = Backgrid.Cell.extend({
    template: _.template('<i class="glyphicon glyphicon-ban-circle"></i>'),
    events: {
      "click": "deleteRow"
    },
    deleteRow: function (e) {
      e.preventDefault();      
      this.model.collection.remove(this.model);
      Backbone.trigger("deleteRowclicked", this.model);
    },
    render: function () {
      this.$el.html(this.template());
      this.delegateEvents();
      return this;
    }
});

var NoteItemColumns = [
{
  name: "delete",
  editable: false,
  sortable: false,
  // The cell type can be a reference of a Backgrid.Cell subclass, any Backgrid.Cell subclass instances like *id* above, or a string
  cell: NoteDeleteCell // This is converted to "StringCell" and a corresponding class in the Backgrid package namespace is looked up
},{
  name: "sku",
  label: "sku",
  editable: false,
  // The cell type can be a reference of a Backgrid.Cell subclass, any Backgrid.Cell subclass instances like *id* above, or a string
  cell: "string" // This is converted to "StringCell" and a corresponding class in the Backgrid package namespace is looked up
}, {
  name: "concepto",
  label: "concepto",
  cell: "string" // An integer cell is a number cell that displays humanized integers
}, {
  name: "price",
  label: "price",
  cell: "number" // A cell type for floating point value, defaults to have a precision 2 decimal numbers
}, {
  name: "quantity",
  label: "quantity",
  cell: "integer",
},{
  name: "discount",
  label: "discount",
  cell: "number",
},{
  name: "total",
  editable: false,
  label: "total",
  cell: "number",
}];

var noteItems = new NoteItems();
NoteItemsGrid = new Backgrid.Grid({
  columns: NoteItemColumns,
  collection: noteItems
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Variants
////////////////////////////////////////////////////////////////////////////////////////////////////////////

VariantClickableRow = Backgrid.Row.extend({
  events: {
    "click": "onClick"
  },
  onClick: function () {
    Backbone.trigger("variantRowclicked", this.model);
  }
});

VariantColumns = [{
  name: "sku",
  label: "sku",
  editable: false,
  // The cell type can be a reference of a Backgrid.Cell subclass, any Backgrid.Cell subclass instances like *id* above, or a string
  cell: "string" // This is converted to "StringCell" and a corresponding class in the Backgrid package namespace is looked up
}, {
  name: "name",
  label: "name",
  editable: false,
  cell: "string" // An integer cell is a number cell that displays humanized integers
}, {
  name: "price",
  label: "price",
  editable: false,
  cell: "number" // A cell type for floating point value, defaults to have a precision 2 decimal numbers
}, {
  name: "stock",
  label: "stock",
  editable: false,
  cell: "integer",
}];

var variantItems = new VariantsPageable()
VariantPageableGrid = new Backgrid.Grid({
  columns:      VariantColumns,
  row:          VariantClickableRow,
  collection:   variantItems
});

Variant_Name_Filter = new Backgrid.Extension.ServerSideFilter({
  name: 'name',
  collection: variantItems,
  fields: ['name']
});

Variant_Sku_Filter  = new Backgrid.Extension.ServerSideFilter({
  name: 'sku',
  collection: variantItems,
  fields: ['sku']
});

Variant_Paginator = new Backgrid.Extension.Paginator({
  collection: variantItems
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Customers
////////////////////////////////////////////////////////////////////////////////////////////////////////////

ClickableCustomerRow = Backgrid.Row.extend({
  events: {
    "click": "onClick"
  },
  onClick: function () {
    Backbone.trigger("customerRowclicked", this.model);
  }
});

CustomerColumns = [{
  name: "fiscalid",
  label: "fiscalid",
  editable: false,
  // The cell type can be a reference of a Backgrid.Cell subclass, any Backgrid.Cell subclass instances like *id* above, or a string
  cell: "string" // This is converted to "StringCell" and a corresponding class in the Backgrid package namespace is looked up
}, {
  name: "firstname",
  label: "name",
  editable: false,
  cell: "string" // An integer cell is a number cell that displays humanized integers
}, {
  name: "lastname",
  label: "lastname",
  editable: false,
  cell: "string" // A cell type for floating point value, defaults to have a precision 2 decimal numbers
}];

var customerItems = new CustomersPageable();
PageableCustomerGrid = new Backgrid.Grid({
  columns:      CustomerColumns,
  row:          ClickableCustomerRow,
  collection:   customerItems
});

Customer_Firstname_Filter = new Backgrid.Extension.ServerSideFilter({
  name: 'firstname',
  collection: customerItems,
  fields: ['firstname']
});

Customer_Lastname_Filter = new Backgrid.Extension.ServerSideFilter({
  name: 'lastname',
  collection: customerItems,
  fields: ['larstname']
});

CustomerPaginator = new Backgrid.Extension.Paginator({
  collection: customerItems
});
//


