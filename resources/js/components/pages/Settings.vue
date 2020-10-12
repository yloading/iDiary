<template>
    <b-container>
        <h1 class="title">Settings</h1>
        <b-form-group
        class="mb-0"
        label="Tag Line 1"
        label-for="textarea-formatter"
        >
        <b-form-textarea
            id="textarea-formatter"
            v-model="text1"
            placeholder="Enter your tag line.."
            :formatter="formatter"
        ></b-form-textarea>
        </b-form-group>
    </b-container>
</template>