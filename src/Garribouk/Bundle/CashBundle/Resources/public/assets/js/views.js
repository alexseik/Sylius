

var TotalView = Backbone.View.extend({
    el : $("#total"), // Specifies the DOM element which this view handles
    template: _.template("total: <%= total %> €"),
    initialize: function() {
        this.listenTo(this.model, "change", this.render);
        this.render;
    },
    render: function() {
        this.$el.html(this.template({total: this.model.get('total')}));
        return this;
    }
});




var DiscountView = Backbone.View.extend({
    el : $("#discount"), // Specifies the DOM element which this view handles
    template: _.template("descuento total: <%= descuento %> €"),
    initialize: function() {
        this.listenTo(this.model, "change", this.render);
        this.render;
    },
    render: function() {
        this.$el.html(this.template({descuento: this.model.get('discount')}));
        return this;
    }
});

var NumItemView = Backbone.View.extend({
    el : $("#num_item"),
    template: _.template("items: <%= numitem %>"),
    initialize: function() {
        this.listenTo(this.model, "change", this.render);
        this.render;
    },
    render: function() {
        this.$el.html(this.template({numitem: this.model.get('items')}));
        return this;
    }
});

var CustomerView = Backbone.View.extend({
    el : $("#customer"), // Specifies the DOM element which this view handles
    template: _.template("<%= firstname %>, <%= lastname %>"),
    initialize: function() {
        this.listenTo(this.model, "change", this.render);
        this.render;
    },
    render: function() {
        this.$el.html(this.template({firstname: this.model.get('firstname'),lastname: this.model.get('lastname')}));
        return this;
    }
});

