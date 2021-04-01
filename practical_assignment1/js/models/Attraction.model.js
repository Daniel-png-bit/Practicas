class Attraction {
    constructor(id, name, description, image, price) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.image = image;
        this.price = price;
        this.quantity = 0;
        this.numPeopleShown = false;
        this.subtotal = this.price * this.quantity;
    }
}