<template>
    <div class="divOuter">
        <div class="divInner">
            <input type="text"
                   maxlength="4"
                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                   onKeyPress="if(this.value.length==4) return false;"
                   class="partitioned sm:max-w-lg focus:ring-cyan-500 focus:border-cyan-500 relative block w-full rounded-md focus:z-10 sm:text-sm border-gray-300"
            />
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>
.partitioned {
    padding-left: 15px;
    letter-spacing: 42px;
    border: 0;
    background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0) 0%);
    background-position: bottom;
    background-size: 50px 1px;
    background-repeat: repeat-x;
    background-position-x: 35px;
    width: 220px;
    min-width: 220px;
}

.divInner{
    left: 0;
    position: sticky;
}

.divOuter{
    width: 190px;
    overflow: hidden;
}
</style>
