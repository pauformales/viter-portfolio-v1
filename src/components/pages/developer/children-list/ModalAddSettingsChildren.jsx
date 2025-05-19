import React from "react";

import { FaTimesCircle } from "react-icons/fa";
import * as Yup from "yup";
import { Form, Formik } from "formik";

import { useMutation, useQueryClient } from "@tanstack/react-query";

import ModalWrapperSide from "../../../partials/modal/ModalWrapperSide";
import { InputText, InputTextArea } from "../../../custom-hooks/FormInputs";
import { queryData } from "../../../helper/queryData";
import { StoreContext } from "../../../../../store/StoreContext";
import {
  setError,
  setMessage,
  setSuccess,
} from "../../../../../store/StoreAction";

const ModalAddSettingsChildren = ({ itemEdit, setIsModal }) => {
  const { store, dispatch } = React.useContext(StoreContext);
  const [animate, setAnimate] = React.useState("translate-x-full");

  const queryClient = useQueryClient();
  const mutation = useMutation({
    mutationFn: (values) =>
      queryData(
        itemEdit
          ? `/rest/v1/controllers/developer/children-list/children-list.php?childrenListid=${itemEdit.children_list_aid}`
          : `/rest/v1/controllers/developer/children-list/children-list.php`,
        itemEdit ? "PUT" : "POST",
        values
      ),
    onSuccess: (data) => {
      queryClient.invalidateQueries({ queryKey: ["children-list"] });

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
    children_list_first_name: itemEdit ? itemEdit.children_list_first_name : "",
    children_list_last_name: itemEdit ? itemEdit.children_list_last_name : "",
    children_list_birthdate: itemEdit ? itemEdit.children_list_birthdate : "",
    children_list_age: itemEdit ? itemEdit.children_list_age : "",
    children_list_donation: itemEdit ? itemEdit.children_list_donation : "",
    children_list_story: itemEdit ? itemEdit.children_list_story : "",
    children_list_first_name_old: itemEdit
      ? itemEdit.children_list_first_name
      : "",
    children_list_last_name_old: itemEdit
      ? itemEdit.children_list_last_name
      : "",

    // children_list_email_old: itemEdit ? itemEdit.children_list_email : "",
  };
  const yupSchema = Yup.object({
    children_list_first_name: Yup.string().required("required"),
    children_list_last_name: Yup.string().required("required"),
    children_list_birthdate: Yup.string().required("required"),
    children_list_donation: Yup.string().required("required"),
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
      <ModalWrapperSide handleClose={handleClose} className={`${animate}`}>
        <div className="modal__header">
          <h3>{itemEdit ? "Update" : "Add"} Children</h3>
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
                  <div className="forms_wrapper">
                    <div className="forms">
                      <div className="relative mt-3 mb-5">
                        <InputText
                          label="Last Name"
                          type="text"
                          name="children_list_last_name"
                          disabled={false}
                        />
                      </div>
                      <div className="relative mt-3 mb-5">
                        <InputText
                          label="First Name"
                          type="text"
                          name="children_list_first_name"
                          disabled={false}
                        />
                      </div>
                      <div className="relative mt-3 mb-5">
                        <InputText
                          label="Birthdate"
                          type="date"
                          name="children_list_birthdate"
                          disabled={false}
                        />
                      </div>
                      <div className="relative mt-3 mb-5">
                        <InputTextArea
                          label="My Story"
                          type="text"
                          name="children_list_story"
                          disabled={false}
                          required={false}
                        />
                      </div>
                      <div className="relative mt-3 mb-5">
                        <InputText
                          label="Donate Amount Limit"
                          type="number"
                          name="children_list_donation"
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

export default ModalAddSettingsChildren;
