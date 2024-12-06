document.addEventListener("DOMContentLoaded", function() {
    // Get the toggle checkbox
    const toggle = document.getElementById('toggle-payment');

    // Monthly and Yearly prices
    const monthlyPrices = {
        juniors: 45,
        student: 75,
        normal: 130
    };

    const yearlyPrices = {
        juniors: 450,
        student: 750,
        normal: 1300
    };

    // Elements for monthly/yearly display
    const juniorsMonthly = document.getElementById('juniors-monthly');
    const juniorsYearly = document.getElementById('juniors-yearly');
    const juniorsPriceType = document.getElementById('juniors-price-type');

    const studentMonthly = document.getElementById('student-monthly');
    const studentYearly = document.getElementById('student-yearly');
    const studentPriceType = document.getElementById('student-price-type');

    const normalMonthly = document.getElementById('normal-monthly');
    const normalYearly = document.getElementById('normal-yearly');
    const normalPriceType = document.getElementById('normal-price-type');

    // Function to toggle monthly/yearly prices
    toggle.addEventListener('change', function() {
        console.log("Toggle changed"); // Debug log to check if the event is firing
        
        if (toggle.checked) {
            // Show Yearly
            juniorsMonthly.style.display = 'none';
            juniorsYearly.style.display = 'block';
            juniorsYearly.textContent = `${yearlyPrices.juniors}$`;
            juniorsPriceType.textContent = 'Yearly';
            
            studentMonthly.style.display = 'none';
            studentYearly.style.display = 'block';
            studentYearly.textContent = `${yearlyPrices.student}$`;
            studentPriceType.textContent = 'Yearly';
            
            normalMonthly.style.display = 'none';
            normalYearly.style.display = 'block';
            normalYearly.textContent = `${yearlyPrices.normal}$`;
            normalPriceType.textContent = 'Yearly';
        } else {
            // Show Monthly
            juniorsMonthly.style.display = 'block';
            juniorsYearly.style.display = 'none';
            juniorsMonthly.textContent = `${monthlyPrices.juniors}$`;
            juniorsPriceType.textContent = 'Monthly';
            
            studentMonthly.style.display = 'block';
            studentYearly.style.display = 'none';
            studentMonthly.textContent = `${monthlyPrices.student}$`;
            studentPriceType.textContent = 'Monthly';
            
            normalMonthly.style.display = 'block';
            normalYearly.style.display = 'none';
            normalMonthly.textContent = `${monthlyPrices.normal}$`;
            normalPriceType.textContent = 'Monthly';
        }
    });
});
