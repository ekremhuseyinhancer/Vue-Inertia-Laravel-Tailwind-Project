<script setup>
import { ref, watch, onMounted } from 'vue';

const props = defineProps({
    status: String,
    pageUpdate: String,
    passwordUpdate: String,
    deleteStatus: String,
});

const message = ref(null);
const isVisible = ref(false);

// Tüm alert'ler için ana renk sınıfları
const GREEN_BASE_CLASSES = 'bg-green-100 border-green-400 text-green-700';
const RED_BASE_CLASSES = 'bg-red-100 border-red-400 text-red-700'; // Kırmızı stil

// Dinamik olarak değişecekler
const alertClasses = ref(GREEN_BASE_CLASSES); // Varsayılan yeşil
const iconPath = ref('');
const alertTitle = ref('');

// İkon tanımları güncellendi
const ICONS = {
    mail: 'M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z',
    info: 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z',
    key: 'M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z',
    trash: 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16',
};


// Mesaj tiplerine göre ikon ve başlık atayan fonksiyon
const setAlertContent = (msg, type) => {
    message.value = msg;
    isVisible.value = true;

    // Rengi varsayılana (Yeşil) sıfırla
    alertClasses.value = GREEN_BASE_CLASSES;

    if (type === 'deleteStatus') { // 🎉 DELETE KONTROLÜ
        alertClasses.value = RED_BASE_CLASSES; // KIRMIZI YAP
        iconPath.value = ICONS.trash;
        alertTitle.value = 'Deleted Successfully!';
    } else if (type === 'status') {
        iconPath.value = ICONS.mail;
        alertTitle.value = 'Email Sent!';
    } else if (type === 'pageUpdate') {
        iconPath.value = ICONS.info;
        alertTitle.value = 'Notified!';
    } else if (type === 'passwordUpdate') {
        iconPath.value = ICONS.key;
        alertTitle.value = 'Password Updated!';
    } else {
        alertClasses.value = 'bg-gray-100 border-gray-400 text-gray-700';
        iconPath.value = ICONS.info;
        alertTitle.value = 'Notification!';
    }

    setTimeout(() => { closeAlert(); }, 5000);
};

const closeAlert = () => {
    isVisible.value = false;
    message.value = null;
};

// Prop izleyicileri güncellendi
watch(() => props.status, (newStatus) => {
    if (newStatus) { setAlertContent(newStatus, 'status'); }
}, { immediate: true });

watch(() => props.pageUpdate, (newPageUpdate) => {
    if (newPageUpdate) { setAlertContent(newPageUpdate, 'pageUpdate'); }
}, { immediate: true });

watch(() => props.passwordUpdate, (newPasswordUpdate) => {
    if (newPasswordUpdate) { setAlertContent(newPasswordUpdate, 'passwordUpdate'); }
}, { immediate: true });

watch(() => props.deleteStatus, (newDeleteStatus) => {
    if (newDeleteStatus) { setAlertContent(newDeleteStatus, 'deleteStatus'); }
}, { immediate: true });


onMounted(() => {
    if (props.deleteStatus) { setAlertContent(props.deleteStatus, 'deleteStatus'); } // En üstte kontrol et
    else if (props.status) { setAlertContent(props.status, 'status'); }
    else if (props.pageUpdate) { setAlertContent(props.pageUpdate, 'pageUpdate'); }
    else if (props.passwordUpdate) { setAlertContent(props.passwordUpdate, 'passwordUpdate'); }
});
</script>

<template>
    <div v-if="isVisible" class="fixed z-50 p-4 transition-opacity duration-300 ease-out top-4 right-4" :class="{ 'opacity-100': isVisible, 'opacity-0': !isVisible }">

        <div
            :class="alertClasses"
            class="max-w-sm p-4 border-l-4 shadow-lg rounded-xl"
            role="alert"
        >
            <div class="flex items-start">
                <div class="py-1 pr-3">
                    <svg class="w-6 h-6"
                         :class="alertClasses.includes('bg-red') ? 'text-red-500' : 'text-green-500'"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="iconPath" />
                    </svg>
                </div>

                <div class="flex-grow">
                    <p class="font-bold">{{ alertTitle }}</p>
                    <p class="text-sm">
                        {{ message }}
                    </p>
                </div>

                <div class="pl-4">
                    <button @click="closeAlert" class="text-current transition-opacity opacity-75 hover:opacity-100">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div v-if="status && !isVisible" class="mb-2 text-sm font-medium text-green-500">{{ status }}</div>
    <div v-if="pageUpdate && !isVisible" class="mt-4 mb-2 text-sm font-medium text-green-500">{{ pageUpdate }}</div>
    <div v-if="passwordUpdate && !isVisible" class="mt-4 mb-2 text-sm font-medium text-green-600">{{ passwordUpdate }}</div>

</template>
