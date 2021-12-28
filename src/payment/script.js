/*
See on github: https://github.com/muhammederdem/credit-card-form
*/

new Vue({
  el: "#app",
  data() {
    visa_card = "4" + Math.floor(Math.random()*10e15).toString();
    amex_card = (Math.floor(Math.random()*4) + 34).toString() + Math.floor(Math.random()*10e14).toString();
    master_card = (Math.floor(Math.random()*5) + 51).toString() + Math.floor(Math.random()*10e14).toString();
    discover_card = "6011" + Math.floor(Math.random()*10e14).toString();
    troy_card = "9792" + Math.floor(Math.random()*10e14).toString();
    list_lastnames = [ "Bonnet", "Royer", "Ferrand", "Begue", "Pruvost", "Jean", "Carpentier", "Bousquet", "Jourdan", "Lopez", "Collet", "Laine", "Bonnin", "Blanchard", "Besnard", "Hubert", "Diallo", "Benard", "Raymond", "Becker", "Lejeune", "Pierre", "Roux", "Albert", "Marechal", "Denis", "Leduc", "Leveque", "Lemaitre", "Maillot", "Martin", "Ollivier", "Turpin", "Texier", "Bodin", "Samson", "Henry", "Leveque", "Cousin", "Blanchard"];
    list_firstnames = [ "Margaux", "Claire", "Martin", "Thomas", "Lorraine", "Henriette", "Margaret", "Valentine", "Christophe", "Édith", "Thierry", "Gilbert", "Maggie", "David", "Eugène", "Antoinette", "Paulette", "Philippe", "Agathe", "Guillaume", "Matthieu", "Lorraine", "Victoire", "Inès", "Noël", "Susanne", "Clémence", "Joseph", "Alexandrie", "Alphonse", "Guillaume", "Léon", "Élisabeth", "Bernadette", "Christophe", "Antoine", "Gilles", "Maryse", "Jules", "Jeannine"];
    card_types = [visa_card, amex_card, master_card, discover_card, troy_card];
    return {
      currentCardBackground: Math.floor(Math.random()* 25 + 1), // just for fun :D
      cardName: (Math.floor(Math.random() * 2) ? 'M. ' : 'Mrs. ') + list_firstnames[Math.floor(Math.random() * list_firstnames.length)] + " " + list_lastnames[Math.floor(Math.random() * list_lastnames.length)],
      cardNumber: card_types[Math.floor(Math.random() * card_types.length)],
      cardMonth: (Math.floor(Math.random() * 12) + 1).toString().padStart(2,'0'),
      cardYear: new Date().getFullYear() + Math.floor(Math.random() * 5) + 1,
      cardCvv: Math.floor(Math.random() * 999).toString().padStart(3,'0'),
      minCardYear: new Date().getFullYear(),
      amexCardMask: "#### #### #### ####",
      otherCardMask: "#### #### #### ####",
      cardNumberTemp: "",
      isCardFlipped: false,
      focusElementStyle: null,
      isInputFocused: false
    };
  },
  mounted() {
    this.cardNumberTemp = this.otherCardMask;
    document.getElementById("cardNumber").focus();
  },
  computed: {
    getCardType () {
      let number = this.cardNumber;
      let re = new RegExp("^4");
      if (number.match(re) != null) return "visa";

      re = new RegExp("^(34|37)");
      if (number.match(re) != null) return "amex";

      re = new RegExp("^5[1-5]");
      if (number.match(re) != null) return "mastercard";

      re = new RegExp("^6011");
      if (number.match(re) != null) return "discover";
      
      re = new RegExp('^9792')
      if (number.match(re) != null) return 'troy'

      return "visa"; // default type
    },
		generateCardNumberMask () {
			return this.getCardType === "amex" ? this.amexCardMask : this.otherCardMask;
    },
    minCardMonth () {
      if (this.cardYear === this.minCardYear) return new Date().getMonth() + 1;
      return 1;
    }
  },
  watch: {
    cardYear () {
      if (this.cardMonth < this.minCardMonth) {
        this.cardMonth = "";
      }
    }
  },
  methods: {
    flipCard (status) {
      this.isCardFlipped = status;
    },
    focusInput (e) {
      this.isInputFocused = true;
      let targetRef = e.target.dataset.ref;
      let target = this.$refs[targetRef];
      this.focusElementStyle = {
        width: `${target.offsetWidth}px`,
        height: `${target.offsetHeight}px`,
        transform: `translateX(${target.offsetLeft}px) translateY(${target.offsetTop}px)`
      }
    },
    blurInput() {
      let vm = this;
      setTimeout(() => {
        if (!vm.isInputFocused) {
          vm.focusElementStyle = null;
        }
      }, 300);
      vm.isInputFocused = false;
    }
  }
});