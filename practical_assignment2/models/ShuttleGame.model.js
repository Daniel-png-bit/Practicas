var OWN_BULLET = 1;
var ENEMY_BULLET = 2;

class ShuttleGame {
    constructor() {
        /* Take some time and read this code and pay close attention
            Can you explain what we are doing here?
        */

        let body = document.querySelector('body');
        this.canvas = document.querySelector('#canvas');
        this.message = 'Press  Enter  to  start!';

        this.shuttle = new Image();
        this.shuttle.src = './practical_assignment2/images/shuttle.png';

        this.background = new Image();
        this.background.src = './practical_assignment2/images/background.gif';

        this.images = new Array();
        this.images.push(this.shuttle);
        this.images.push(this.background);

        this.speed = 30;
        this.playing = false;

        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;

        this.shuttleX = canvas.width / 2;
        this.shuttleY = canvas.height - 150;
        
        this.ctx = canvas.getContext('2d');
        
        let moveLeftAction = this.moveLeft.bind(this);
        let moveRightAction = this.moveRight.bind(this);
        let fireBulletAction = this.fireBullet.bind(this);
        let startAction = this.start.bind(this);

        body.addEventListener('keydown', function(event) {
            if (event.keyCode == 37) {
                moveLeftAction();
            } else if (event.keyCode == 39) {
                moveRightAction();
            } else if (event.keyCode == 13) {
                startAction();
            }
        });

        let numImages = 0;
        let updateCall = this.update.bind(this);

        for (let image of this.images) {
            image.onload = function() {
                if (++numImages >= 2) {
                    setInterval(updateCall, 10);
                }
            }
        }
    }

    start() {
        /* 2. Implement the logic of the start method
            If the gamer is already playing, leave.
            Set the shuttle's initial position to x = canvas.width / 2
            and y = canvas.height - 150;

            Also configure the rate at which enemy bullets are generated, for example 2000
            Also configure the rate at which own bullets are generated, for example 500

            Initialize all relevant variables

            And finally call the showPoints() method

        */

        if (this.playing) {
            return;
        }

        this.shuttleX = canvas.width / 2;
        this.shuttleY = canvas.height - 150;

        let fireBulletCall = this.fireBullet.bind(this);
        setInterval(fireBulletCall, 500);

        let generateEnemyBulletsCall = this.generateEnemyBullets.bind(this);
        setInterval(generateEnemyBulletsCall, 2000);

        this.ownBullets = new Array();
        this.enemyBullets = new Array();

        this.playing = true;
        this.points = 0;

        this.showPoints();
    }

    showPoints() {
        /* 3. Implement showPoints method
            that show the number of points accumulated
        */
        
        this.message = 'POINTS:  ' + this.points;
    }

    gameOver() {
        /* 4. Implement gameOver method
            that sets the playing attribute to false
            and shows GAME OVER!!!
        */
        
        this.playing = false;
        this.message = 'GAME  OVER!!!';
        location.reload();

    }

    update() {
        /* Pay close attention to this method
            What exactly are we doing here?
        */

        let ctx = this.ctx;

        var ptrn = ctx.createPattern(this.background, 'repeat');
        ctx.fillStyle = ptrn;
        ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

        if (this.playing) {
            this.checkCollisions();

            this.cleanFiredBullets(this.ownBullets);
            this.cleanFiredBullets(this.enemyBullets);

            for (let ownBullet of this.ownBullets) {
                ownBullet.moveUp();
                ownBullet.draw();
            }

            for (let enemyBullet of this.enemyBullets) {
                enemyBullet.moveDown();
                enemyBullet.draw();
            }
        } else {
            if (this.ownBullets) {
                for (let ownBullet of this.ownBullets) {
                    ownBullet.draw();
                }
            }

            if (this.enemyBullets) {
                for (let enemyBullet of this.enemyBullets) {
                    enemyBullet.draw();
                }
            }
        }

        ctx.drawImage(this.shuttle, this.shuttleX, this.shuttleY);

        ctx.fillStyle = 'white';
        ctx.font = '30pt Arcade';
        ctx.fillText(this.message, 30, 40);
    }

    checkCollisions() {
        /*
            9. Implement checkCollisions method
            that checks whether an enemy bullet collides with an own bullet

            If an enemy bullet either collides with the shuttle or
            reaches the floor, call the gameOver method
        */

        for (let enemyBullet of this.enemyBullets) {
            if ((Math.abs(this.shuttleX - enemyBullet.x) < 50 && 
                    Math.abs(this.shuttleY - enemyBullet.y) < 20) ||
                    (enemyBullet.y >= this.canvas.height - enemyBullet.height)) {
                
                this.gameOver();
                return;
            }
        }

        for (let ownBullet of this.ownBullets) {
            let i = this.enemyBullets.length;

            while (i--) {
                let enemyBullet = this.enemyBullets[i];

                if (Math.abs(ownBullet.x - enemyBullet.x) < 60 &&
                    Math.abs(ownBullet.y - enemyBullet.y) < 20) {
                    
                    this.points++;
                    this.enemyBullets.splice(i, 1);
                    this.showPoints();
                    break;
                }
            }
        }
    }

    cleanFiredBullets(bullets) {
            /**
         * Check this code. Can you explain what we are doing here?
         */

        let i = bullets.length;

        while (i--) {
            let bullet = bullets[i];
            if (bullet.type == OWN_BULLET && bullet.y <= -bullet.height) {
                bullets.splice(i, 1);
            }
        }
    }

    moveLeft() {
        /* 5. Implement moveLeft method that shifts the shuttle to the left
            Do this only while gamer is playing
        */

        if (this.playing  && this.shuttleX > 0) {
            this.shuttleX -= this.speed;
        }
    }

    moveRight() {
        /* 6. Implement moveLeft method that shifts the shuttle to the right
            Do this only while gamer is playing
        */
        
        if (this.playing && this.shuttleX < this.canvas.width - 110) {
            this.shuttleX += this.speed;
        }
    }

    fireBullet() {
        /*
            7. Implement fireBullet method that fires own bullets
            Do this only while playing
        */

        if (!this.playing) {
            return;
        }

        let lastFiredBullet = new Bullet(this.shuttleX + 40, this.shuttleY, OWN_BULLET, 10, this.ctx);
        this.ownBullets.push(lastFiredBullet);
    }

    generateEnemyBullets() {
        /*
            8. Implement generateEnemyBullets method that creates
            enemy bullets

            Do this only while playing
        */

        if (!this.playing) {
            return;
        }

        let x = Math.random() * (this.canvas.width * 2 / 3) + this.canvas.width / 6;
        let enemyBullet = new Bullet(x, 0, ENEMY_BULLET, 3, this.ctx);
        this.enemyBullets.push(enemyBullet);
    }
}