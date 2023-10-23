
export function toastf() {
    toast.classList.add("show");
    setTimeout(function () {
      toast.classList.remove("show");
    }, 2000);
  }