<style>
    /* Container for the message popup */
    .message-container {
        text-align: center;
        font-size: 2rem;
        color: #fff;
        background: -webkit-linear-gradient(left,#003366,#004080,#0059b3
, #0073e6);
        padding: 20px 40px;
        border-radius: 30px;
        box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.15);
        position: absolute;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        animation: moveUpDown 3s ease-in-out infinite, scaleUp 2s ease-in-out infinite alternate;
        transition: all 0.3s ease;
        border: 2px solid #fff;
    }

    /* Text effect for the message */
    .message-text {
        font-size: 1.5rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        animation: textGlow 2s ease-in-out infinite alternate;
    }

    /* Keyframe for moving the popup up and down */
    @keyframes moveUpDown {
        0% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-50px);
        }
        100% {
            transform: translateY(0);
        }
    }

    /* Keyframe for scaling the popup */
    @keyframes scaleUp {
        0% {
            transform: scale(1);
        }
        100% {
            transform: scale(1.05);
        }
    }

    /* Glowing effect on the message text */
    @keyframes textGlow {
        0% {
            text-shadow: 0px 0px 15px rgba(255, 255, 255, 0.8);
        }
        100% {
            text-shadow: 0px 0px 25px rgba(255, 255, 255, 1);
        }
    }

    /* Styling for smooth text motion */
    .message-container:hover {
        transform: scale(1.1);
    }
</style>

<div class="message-container" id="message">
    <div class="message-text">Additional Feature Will Be Adding Soon!</div>
</div>

<script>
    const message = document.getElementById('message');
    let xPos = 0;
    let yPos = 0;
    const speed = 3;

    function moveText() {
        // Move down first
        if (yPos < window.innerHeight - message.offsetHeight) {
            yPos += speed;
        } else {
            // After reaching bottom, move right
            if (xPos < window.innerWidth - message.offsetWidth) {
                xPos += speed;
            } else {
                xPos = 0; // Reset to left
                yPos = 0; // Reset to top
            }
        }

        // Update the position of the message container
        message.style.left = `${xPos}px`;
        message.style.top = `${yPos}px`;

        requestAnimationFrame(moveText); // Keep moving the text
    }

    moveText(); // Start the movement when the page loads
</script>
