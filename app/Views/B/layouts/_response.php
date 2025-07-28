<?php if (session()->has('response_message')): ?>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            <?php
            $response = session()->get('response_message');
            $messages = is_array($response['data']) ? $response['data'] : [$response['data']];
            foreach ($messages as $msg):
            ?>
            window.dispatchEvent(new CustomEvent('notify', {
                detail: {
                    message: "<?= esc(addslashes($msg)) ?>",
                    type: "<?= $response['status'] === 'success' ? 'success' : 'error' ?>"
                }
            }));
            <?php endforeach; ?>
        });
    </script>
<?php endif; ?>

<?php if (session()->has('success')): ?>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: {
                    message: "<?= esc(addslashes(session('success'))) ?>",
                    type: "success"
                }
            }));
        });
    </script>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: {
                    message: "<?= esc(addslashes(session('error'))) ?>",
                    type: "error"
                }
            }));
        });
    </script>
<?php endif; ?>

<!-- Component Toast Notification -->
<div x-show="notification.show" x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform translate-y-2"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-2"
     @notify.window="showNotification($event.detail.message, $event.detail.type)"
     :class="{
         'bg-blue-600': notification.type === 'info',
         'bg-green-600': notification.type === 'success',
         'bg-yellow-500': notification.type === 'warning',
         'bg-red-600': notification.type === 'error'
     }"
     class="fixed bottom-5 right-5 p-4 rounded-lg text-white shadow-md z-[100] max-w-sm w-full">
    <p x-text="notification.message"></p>
</div>

<script>
function appData() {
    return {
        notification: { show: false, message: '', type: 'info' },
        notificationQueue: [],
        showNotification(message, type = 'info') {
            this.notificationQueue.push({ message, type });
            if (!this.notification.show) this.showNext();
        },
        showNext() {
            if (this.notificationQueue.length === 0) return;
            const { message, type } = this.notificationQueue.shift();
            this.notification.message = message;
            this.notification.type = type;
            this.notification.show = true;
            setTimeout(() => {
                this.notification.show = false;
                setTimeout(() => this.showNext(), 300); // khoảng cách giữa 2 toast
            }, 3500);
        }
    };
}
</script>
