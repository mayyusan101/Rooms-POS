import { computed, toValue } from "vue";

// isRef(interestRate) ? interestRate.value : interestRate === toValue(interestRate)
export const useMonthlyPayment = (total, interestRate, duration) => {
    const monthlyPayment = computed(() => {
        const principle = toValue(total);
        const monthlyInterest = toValue(interestRate) / 100 / 12;
        const numberOfPaymentMonths = toValue(duration) * 12;
        return (
            (principle *
                monthlyInterest *
                Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) /
            (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
        );
    });

    const totalPaid = computed(
        () => toValue(duration) * 12 * monthlyPayment.value
    );

    const totalInterest = computed(() => totalPaid.value - toValue(total));

    return { monthlyPayment, totalPaid, totalInterest };
};
