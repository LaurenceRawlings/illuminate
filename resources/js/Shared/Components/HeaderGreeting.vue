<template>
    <div class="grid gap-4 grid-cols-2 divide-x-2 divide-gray-300 place-items-center">
        <div>
            <application-mark/>
        </div>

        <div class="text-xl font-black align-middle pl-4 mt-3">{{ greeting() }}</div>
    </div>
</template>

<script>
import ApplicationMark from "@/Jetstream/ApplicationMark";

export default {
    components: {
        ApplicationMark
    },
    methods: {
        greeting() {
            let hour = new Date().getHours();
            let greeting = "Good ";

            if (hour >= 5 && hour < 12) {
                greeting = greeting.concat("morning");
            } else if (hour >= 12 && hour < 18) {
                greeting = greeting.concat("afternoon");
            } else if (hour >= 18) {
                greeting = greeting.concat("evening");
            } else {
                greeting = greeting.concat("night");
            }

            return greeting;
        },
    }
}
</script>

<style scoped>

</style>
