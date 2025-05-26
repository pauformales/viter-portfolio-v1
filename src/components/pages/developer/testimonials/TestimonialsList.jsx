import React from "react";

import * as Yup from "yup";
import Footer from "../../../partials/Footer";
import Header from "../../../partials/Header";
import Navigation from "../Navigation";
import BreadCrumbs from "../../../partials/BreadCrumbs";
import TestimonialsListTable from "./TestimonialsListTable";
import ModalAddSettingsTestimonials from "./ModalAddSettingsTestimonials";
import { FaPlus } from "react-icons/fa6";

const TestimonialsList = () => {
  const [itemEdit, setItemEdit] = React.useState(null);
  const [isModalTestimonials, setIsModalTestimonials] = React.useState(false);

  const handleAdd = () => {
    setItemEdit(null);
    setIsModalTestimonials(true);
  };

  const currentMenu = location.pathname.startsWith("/testimonials")
    ? "/testimonials-list"
    : "";

  return (
    <>
      <Header />

      <Navigation menu="testimonials" subMenu="testimonials" />

      <div className="wrapper ">
        {/*BREADCRUMBS OR ADD BUTTON*/}

        <div className="flex items-center justify-between py-2">
          <BreadCrumbs param={location.search} />

          <button
            type="button"
            className="flex items-center gap-x-1 text-white hover:underline text-sm"
            onClick={handleAdd}
          >
            <FaPlus />
            <span>Add</span>
          </button>
        </div>

        {/*CONTENT*/}
        <div className="pb-8">
          <h2 className="text-base">Testimonials</h2>
          <div className="pt-3">
            <TestimonialsListTable
              setItemEdit={setItemEdit}
              setIsModal={setIsModalTestimonials}
            />
          </div>
        </div>

        {/*FOOTER*/}
        <Footer />

        {isModalTestimonials && (
          <ModalAddSettingsTestimonials
            itemEdit={itemEdit}
            setIsModal={setIsModalTestimonials}
          />
        )}
      </div>
    </>
  );
};

export default TestimonialsList;
