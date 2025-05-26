import React from "react";

import { FaTimesCircle } from "react-icons/fa";
import * as Yup from "yup";
import { Form, Formik } from "formik";

import { useMutation, useQueryClient } from "@tanstack/react-query";

import {
  setError,
  setMessage,
  setSuccess,
} from "../../../../../store/StoreAction";
import ModalWrapperSide from "../../../partials/modal/ModalWrapperSide";
import { InputText, InputTextArea } from "../../../custom-hooks/FormInputs";
import { queryData } from "../../../helper/queryData";
import { StoreContext } from "../../../../../store/StoreContext";

const ModalAddSettingsTestimonials = ({ itemEdit, setIsModal }) => {
  const { store, dispatch } = React.useContext(StoreContext);
  const [animate, setAnimate] = React.useState("translate-x-full");

  const queryClient = useQueryClient();
  const mutation = useMutation({
    mutationFn: (values) =>
      queryData(
        itemEdit
          ? `/rest/v1/controllers/developer/testimonials/testimonials.php?maintestimonialsid=${itemEdit.maintestimonials_aid}`
          : `/rest/v1/controllers/developer/testimonials/testimonials.php`,
        itemEdit ? "PUT" : "POST",
        values
      ),
    onSuccess: (data) => {
      queryClient.invalidateQueries({ queryKey: ["testimonials-list"] });

      if (!data.success) {
        dispatch(setMessage(data.error));
        dispatch(setError(true));
      } else {
        setIsModal(false);
        dispatch(setMessage(`Successfully ${itemEdit ? "updated" : "added"}.`));
        dispatch(setSuccess(true));
      }
    },
  });

  const initVal = {
    maintestimonials_first_name: itemEdit
      ? itemEdit.maintestimonials_first_name
      : "",
    maintestimonials_last_name: itemEdit
      ? itemEdit.maintestimonials_last_name
      : "",
    maintestimonials_email: itemEdit ? itemEdit.maintestimonials_email : "",
    maintestimonials_description: itemEdit
      ? itemEdit.maintestimonials_description
      : "",
  };
  const yupSchema = Yup.object({
    maintestimonials_first_name: Yup.string().required("required"),
    maintestimonials_last_name: Yup.string().required("required"),
    maintestimonials_email: Yup.string()
      .email("Invalid email")
      .required("required"),
    maintestimonials_description: Yup.string().required("required"),
  });

  const handleClose = () => {
    setAnimate("translate-x-full");
    setTimeout(() => {
      setIsModal(false); // CLOSE MODAL
    }, 200);
  };

  React.useEffect(() => {
    setAnimate();
  }, []);

  return (
    <>
      <ModalWrapperSide
        handleClose={handleClose}
        className={` moodal ${animate}`}
      >
        <div className="modal__header">
          <h3>{itemEdit ? "Update" : "Add"} Testimonials</h3>
          <button
            type="button"
            className="absolute top-0 right-0"
            onClick={handleClose}
          >
            <FaTimesCircle className="text-lg" />
          </button>
        </div>

        <div className="modal__body">
          <Formik
            initialValues={initVal}
            validationSchema={yupSchema}
            onSubmit={async (values, { setSubmitting, resetForm }) => {
              mutation.mutate(values);
            }}
          >
            {(props) => {
              return (
                <Form>
                  <div className="forms_wrapper ">
                    <div className="forms">
                      <div className="relative mt-3 mb-5">
                        <InputText
                          label="First Name"
                          type="text"
                          name="maintestimonials_first_name"
                          disabled={false}
                        />
                      </div>
                      <div className="relative mt-3 mb-5">
                        <InputText
                          label="Last Name"
                          type="text"
                          name="maintestimonials_last_name"
                          disabled={false}
                        />
                      </div>
                      <div className="relative mt-3 mb-5">
                        <InputText
                          label="Email"
                          type="text"
                          name="maintestimonials_email"
                          disabled={false}
                        />
                      </div>

                      <div className="relative mt-3 mb-5">
                        <InputTextArea
                          label="Description"
                          type="text"
                          name="maintestimonials_description"
                          disabled={false}
                        />
                      </div>
                    </div>
                    <div className="actions">
                      <button
                        type="submit"
                        className="btn-modal-submit"
                        disabled={!props.dirty}
                      >
                        {itemEdit ? "Save" : "Add"}
                      </button>
                      <button
                        type="reset"
                        className="btn-modal-cancel"
                        onClick={handleClose}
                      >
                        Cancel
                      </button>
                    </div>
                  </div>
                </Form>
              );
            }}
          </Formik>
        </div>
      </ModalWrapperSide>
    </>
  );
};

export default ModalAddSettingsTestimonials;
