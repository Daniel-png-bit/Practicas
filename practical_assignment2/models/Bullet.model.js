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
            this.ownBullet = new Image()
            this.ownBullet.src = './practical_assignment2/images/ownBullet.png'
            
            this.ctx.drawImage(this.ownBullet, this.x, this.y, this.width, this.height)

        } else {
            this.enemyBullet = new Image()
            this.enemyBullet.src = './practical_assignment2/images/enemyBullet.png'
 
            this.ctx.drawImage(this.enemyBullet, this.x, this.y)
        }

    }
}