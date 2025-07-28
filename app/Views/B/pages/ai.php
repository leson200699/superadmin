

    <style>
        @import url('https://fonts.googleapis.com/css?family=Google+Sans:100,300,400,500,700,900,100i,300i,400i,500i,700i,900i&display=swap');
        /* Chat box */

        body {font-family: "Google Sans", sans-serif;}

/*        #chat-box {
            width: 100%;
            height: 400px;
            border: 1px solid #ccc;
            overflow-y: scroll;
            padding: 10px;
            background-color: #f9f9f9;
            
        }*/

        /* Tin nhбєЇn cб»§a ngЖ°б»ќi dГ№ng */
        .user-message {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            max-width: 70%;
            align-self: flex-end;
            font-family: Google Sans, sans-serif;
        }


        .ai-message {
            background-color: #e9ecef;
            color: black;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            max-width: 70%;
            align-self: flex-start;
            font-family: Google Sans, sans-serif;
        }


        .typing-indicator {
            display: inline-block;
            margin-left: 5px;
        }
        .typing-indicator span {
            display: inline-block;
            width: 5px;
            height: 5px;
            background-color: #999;
            border-radius: 50%;
            margin-right: 3px;
            animation: typing 1s infinite;
        }
        .typing-indicator span:nth-child(2) {
            animation-delay: 0.2s;
        }
        .typing-indicator span:nth-child(3) {
            animation-delay: 0.4s;
        }
        @keyframes typing {
            0%, 100% { opacity: 0; }
            50% { opacity: 1; }
        }


        #user-input {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: "Google Sans", sans-serif;
        }
        #send-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #send-btn:hover {
            background-color: #0056b3;
        }
    </style>
    <h2 class="main-title mb-3">Trò chuyện với AM Experience AI hỗ trợ Marketing</h2>
    <div id="chat-box"></div>
    <input type="text" id="user-input" placeholder="Nhập nội dung...">
    <button id="send-btn">Gửi</button>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
         
            $('#send-btn').click(function() {
                const userMessage = $('#user-input').val();
                if (userMessage.trim() === '') return;

                $('#chat-box').append(`<div class="user-message"><strong>Bạn:</strong> ${userMessage}</div>`);
                $('#user-input').val(''); 

            
                $('#chat-box').append(`
                    <div class="ai-message">
                        <strong>AM AI:</strong>
                        <span class="typing-indicator">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </div>
                `);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight); 

             
                $.ajax({
                    url: '<?= site_url('/admin/dashboard/sendMessage') ?>',
                    method: 'POST',
                    data: { message: userMessage },
                    dataType: 'json',
                    success: function(response) {
                      
                        $('.typing-indicator').parent().remove();

                 
                        $('#chat-box').append(`<div class="ai-message"><strong>AM AI:<br></strong> ${response.message}</div>`);
                        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                    },
                    error: function() {
                    
                        $('.typing-indicator').parent().remove();
                        alert('Có lỗi xảy ra, vui lòng thử lại.');
                    }
                });
            });

        
            $('#user-input').keypress(function(e) {
                if (e.which === 13) {
                    $('#send-btn').click();
                }
            });
        });
    </script>

