<div x-show="calendarOpen"
    class=" m-auto bg-black backdrop-filter backdrop-blur-lg bg-opacity-5 flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-transparent " @click.away="calendarOpen = false">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 rounded-t dark:border-gray-600">
                <button @click="calendarOpen = false" type="button"
                    class="text-red-400 bg-transparent hover:bg-red-400 hover:text-white rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div x-data="calendarComponent()" x-init="init()" class="flex items-center justify-center h-auto">
                <div class="lg:w-fit md:w-fit sm:w-fit mx-auto p-4">
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="flex items-center justify-between px-6 py-3 bg-purple-950">
                            <button @click="prevMonth()" class="text-white">Previous</button>
                            <h2 class="text-white" x-text="currentMonthName + ' ' + currentYear"></h2>
                            <button @click="nextMonth()" class="text-white">Next</button>
                        </div>
                        <div @click="calendarOpen = false" class="grid grid-cols-7 gap-2 p-4" x-ref="calendar">
                            <!-- Calendar Days Go Here -->
                        </div>
                        <!-- Display the selected date here -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function calendarComponent() {
        return {
            currentYear: new Date().getFullYear(),
            currentMonth: new Date().getMonth(),
            selectedDate: null,
            philippineHolidays: [],

            init() {
                this.fetchHolidays();
                this.generateCalendar();
                this.$watch('selectedDate', (value) => {
                    this.$dispatch('date-selected', value);
                });
            },

            async fetchHolidays() {
                try {
                    const response = await fetch('/holidays');
                    const holidays = await response.json();
                    this.philippineHolidays = holidays.map(holiday => new Date(holiday.holiday_date));
                    this.generateCalendar(); // Regenerate calendar after fetching holidays
                } catch (error) {
                    console.error('Error fetching holidays:', error);
                }
            },

            generateCalendar() {
                const calendarElement = this.$refs.calendar;
                const currentDate = new Date(); // Today's date
                const minDisabledDate = new Date(currentDate);
                minDisabledDate.setDate(currentDate.getDate() + 3); // 3 days after today

                const firstDayOfMonth = new Date(this.currentYear, this.currentMonth, 1);
                const daysInMonth = new Date(this.currentYear, this.currentMonth + 1, 0).getDate();

                calendarElement.innerHTML = '';

                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                    'September', 'October', 'November', 'December'];
                this.currentMonthName = monthNames[this.currentMonth];

                const firstDayOfWeek = firstDayOfMonth.getDay();

                const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                daysOfWeek.forEach(day => {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'text-center font-semibold';
                    dayElement.innerText = day;
                    calendarElement.appendChild(dayElement);
                });

                // Add empty slots for days before the first day of the month
                for (let i = 0; i < firstDayOfWeek; i++) {
                    const emptyDayElement = document.createElement('div');
                    calendarElement.appendChild(emptyDayElement);
                }

                // Generate the days of the month
                for (let day = 1; day <= daysInMonth; day++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'text-center py-2 border cursor-pointer';
                    dayElement.innerText = day;

                    const dateToCheck = new Date(this.currentYear, this.currentMonth, day);

                    // Disable past dates, next 3 days, weekends, and holidays
                    if (
                        dateToCheck < currentDate ||
                        dateToCheck <= minDisabledDate ||
                        dateToCheck.getDay() === 0 ||
                        dateToCheck.getDay() === 6 ||
                        this.isHoliday(dateToCheck)
                    ) {
                        dayElement.classList.add('disabled-day');
                    }

                    // Highlight the current day
                    if (this.currentYear === currentDate.getFullYear() &&
                        this.currentMonth === currentDate.getMonth() &&
                        day === currentDate.getDate()) {
                        dayElement.classList.add('bg-blue-500', 'text-white');
                    }

                    // Add click event to select a date
                    dayElement.addEventListener('click', () => {
                        if (!dayElement.classList.contains('disabled-day')) {
                            this.selectDate(dayElement, dateToCheck);
                        }
                    });

                    calendarElement.appendChild(dayElement);
                }
            },

            isHoliday(dateToCheck) {
                return this.philippineHolidays.some(holiday =>
                    holiday.getDate() === dateToCheck.getDate() &&
                    holiday.getMonth() === dateToCheck.getMonth() &&
                    holiday.getFullYear() === dateToCheck.getFullYear()
                );
            },

            selectDate(dayElement, date) {
                this.clearSelectedDate();
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                this.selectedDate = date.toLocaleDateString(undefined, options);
                dayElement.classList.add('selected-day');
                this.$dispatch('date-selected', this.selectedDate);
            },

            clearSelectedDate() {
                const selectedElements = this.$refs.calendar.querySelectorAll('.selected-day');
                selectedElements.forEach(el => el.classList.remove('selected-day'));
            },

            prevMonth() {
                this.currentMonth--;
                if (this.currentMonth < 0) {
                    this.currentMonth = 11;
                    this.currentYear--;
                }
                this.generateCalendar();
            },

            nextMonth() {
                this.currentMonth++;
                if (this.currentMonth > 11) {
                    this.currentMonth = 0;
                    this.currentYear++;
                }
                this.generateCalendar();
            }
        };
    }
</script>

