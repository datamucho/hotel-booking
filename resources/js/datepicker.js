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
                theme: "light",
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

                // If check-out date is before check-in, update it
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
