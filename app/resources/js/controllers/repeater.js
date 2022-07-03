export default class extends window.Controller {
    connect() {
        this.section        = document.getElementById(this.element.querySelector('.repeater').id);
        this.section_blocks = this.section.querySelector(".repeater__blocks");
        this.count          = this.data.get("count");
        this.name           = this.data.get("name");
        this.layout         = this.data.get("layout");
        this.urlFetch       = this.data.get("url-fetch");
        this.urlAdd         = this.data.get("url-add");
        this.value          = this.data.get("value");

        this.fetchBlocks();
    }

    fetchBlocks() {
        axios.post(this.urlFetch, {
            layout: this.layout,
            name: this.name,
            value: this.value,
        }).then((response) => {
            this.section_blocks.insertAdjacentHTML("afterbegin", response.data);
        });
    }

    addBlock() {
        axios.post(this.urlAdd, {
            layout: this.layout,
            name: this.name,
            count: this.count++,
        }).then((response) => {
            this.section_blocks.insertAdjacentHTML("beforeend", response.data);
        });
    }

    removeBlock(event) {
        event.currentTarget.closest(".repeater__blocks-item").remove();
    }
}
