    <div x-data="notificationsComponent()" class="relative hover:cursor-pointer">
        <!-- Bell Icon -->
        <div @click="toggleDropdown()">
            <i data-lucide="bell" class="text-white"></i>
            <span x-show="hasUnread" class="absolute top-0.5 right-0 block h-2 w-2 rounded-full bg-red-600"></span>
        </div>

        <!-- Notification Dropdown -->
        <div x-show="open" x-transition @click.outside="closeDropdown()"
            class="absolute my-4 md:my-3 bg-white shadow-lg rounded p-3 w-80 md:w-[500px] max-h-96 z-50 right-0 md:right-[-13rem] overflow-y-auto scrollbar-hidden">

            <template x-if="notifications.length === 0">
                <p class="text-gray-700 text-sm text-center">No new notifications.</p>
            </template>

            <template x-for="notification in notifications" :key="notification.id">
                <div class="border-b border-gray-200 p-2 hover:bg-gray-100 rounded">
                    <a :href="getLink(notification.links_to)"
                        class="flex flex-col gap-1"
                        @click="markAsRead(notification.id)">
                        <p :class="{'font-bold': !notification.is_read, 'text-gray-800': true}" class="text-sm"
                            x-text="notification.content"></p>
                        <span class="text-xs text-gray-500" x-text="humanDiff(notification.created_at)"></span>
                    </a>
                </div>
            </template>
        </div>
    </div>

    <script>
        function notificationsComponent() {
            return {
                open: false,
                notifications: [],
                hasUnread: false,

                toggleDropdown() {
                    this.open = !this.open;
                    if (!this.open) {
                        this.markAllAsRead();
                    }
                },

                closeDropdown() {
                    this.open = false;
                    this.markAllAsRead();
                },

                fetchNotifications() {
                    fetch("{{ route('notifications.get') }}")
                        .then(res => res.json())
                        .then(data => {
                            this.notifications = data.map(n => ({
                                ...n
                            }));
                            this.hasUnread = this.notifications.some(n => n.is_read === 0);
                        });
                },

                markAllAsRead() {
                    // mark in frontend
                    this.notifications = this.notifications.map(n => ({
                        ...n,
                        is_read: 1
                    }));
                    this.hasUnread = false;

                    // persist in backend
                    fetch("{{ route('notifications.markAsRead') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    });
                },

                markAsRead(id) {
                    // only persist in backend, don't update bold
                    fetch("{{ route('notifications.markAsRead') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            id
                        })
                    });
                },

                getLink(type) {
                    return type === 1 ? "{{ route('clinic.appointments') }}" :
                        type === 2 ? "{{ route('clinic.messages') }}" :
                        type === 3 ? "{{ route('clinic.supplies') }}" : "#";
                },

                humanDiff(createdAt) {
                    const now = new Date();
                    const created = new Date(createdAt);
                    const diff = Math.floor((now - created) / 1000);

                    if (diff < 5) return 'Just now';
                    if (diff < 60) return `${diff} second${diff > 1 ? 's' : ''} ago`;

                    const minutes = Math.floor(diff / 60);
                    if (minutes < 60) return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;

                    const hours = Math.floor(minutes / 60);
                    if (hours < 24) return `${hours} hour${hours > 1 ? 's' : ''} ago`;

                    const days = Math.floor(hours / 24);
                    if (days < 30) return days === 1 ? 'Yesterday' : `${days} day${days > 1 ? 's' : ''} ago`;

                    const months = Math.floor(days / 30);
                    if (months < 12) return `${months} month${months > 1 ? 's' : ''} ago`;

                    const years = Math.floor(months / 12);
                    return `${years} year${years > 1 ? 's' : ''} ago`;
                },

                init() {
                    this.fetchNotifications();
                }
            }
        }
    </script>