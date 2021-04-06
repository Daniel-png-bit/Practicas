class Bullet {
    constructor(x, y, type, speed, ctx) {
        this.x = x;
        this.y = y;
        this.type = type;
        this.ctx = ctx;
        this.speed = speed;
        this.width = 20;
        this.height = 40;
    }

    moveUp() {
        this.y -= this.speed;
    }

    moveDown() {
        this.y += this.speed;
    }

    draw() {
        if (this.type == OWN_BULLET) {
            this.ctx.fillStyle = 'rgb(255, 255, 255)';
        } else {
            this.ctx.fillStyle = 'yellow';
        }

        this.ctx.fillRect(this.x + this.width * 2, this.y, this.width, this.height);
    }
}