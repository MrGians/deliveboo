<template>
    <footer>
        <div class="container">
            <div class="top-footer">
                <p>DeliveBoo since 2022. P.iva 12332154321. Accepting this payments methods: </p>
                <img class="payment-card-meth"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/MasterCard_Logo.svg/2560px-MasterCard_Logo.svg.png"
                    alt="MasterCrad Payment">
                <img class="payment-card-meth"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Visa.svg/640px-Visa.svg.png"
                    alt="Visa Payment">
            </div>
            <div class="bottom-footer">
                <p>Developed with &hearts; from Team proj-1
                    <a href="https://github.com/Gabridg">Gabriele Del Guerzo</a>,
                    <a href="https://github.com/MrGians">Gianluca Mura</a>,
                    <a href="https://github.com/GiuseppeBergamo">Giuseppe Bergamo</a>,
                    <a href="https://github.com/Fabiopanetta02">Fabio Panetta</a>,
                    <a href="https://github.com/liviaAugusta">Livia A. Mattoni</a>.
                </p>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: 'BaseFooter',
}

</script>

<style scoped lang="scss">
@import "./../../sass/front.scss";

footer {
    height: 450px;
    background-image: url('/img/footer.png');
    background-repeat: no-repeat;
    background-position: bottom center;
    background-size: cover;
    padding-top: 50px;
    margin-top: 250px;

    .top-footer {
        display: flex;
        justify-content: center;
        align-items: center;
        color: $body-bg;

        .payment-card-meth {
            display: block;
            height: 70px;
            width: auto;
            margin-left: 20px;

        }
    }

    .bottom-footer {
        padding-top: 80px;
        color: #fff;

        a {
            color: $secondary;

            &:hover {
                color: $tertiary;
            }
        }

    }

}
</style>