class DatePicker {
    constructor() {
        this.init();
    }

    init() {
        const dateInputs = document.querySelectorAll("[data-datepicker]");

        dateInputs.forEach((input) => {
            flatpickr(input, {
                dateFormat: "Y-m-d",
                minDate: input.dataset.minDate || "today",
                disableMobile: true,
                animate: true,
                position: "auto",
                theme: "airbnb",
                monthSelectorType: "static",
                prevArrow: `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>`,
                nextArrow: `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>`,
                onChange: (selectedDates, dateStr, instance) =>
                    this.handleDateChange(
                        selectedDates,
                        dateStr,
                        instance,
                        input
                    ),
            });
        });
    }

    handleDateChange(selectedDates, dateStr, instance, input) {
        if (input.name === "check_in") {
            const checkOut = document.querySelector('[name="check_out"]');
            if (checkOut) {
                const nextDay = new Date(selectedDates[0]);
                nextDay.setDate(nextDay.getDate() + 1);
                const checkOutPicker = checkOut._flatpickr;
                checkOutPicker.set("minDate", nextDay);

                if (checkOutPicker.selectedDates[0] <= selectedDates[0]) {
                    checkOutPicker.setDate(nextDay);
                }
            }
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
    new DatePicker();
});
