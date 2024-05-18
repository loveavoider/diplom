'use client';
import { haveJWT } from "@/app/util/auth";
import {useState, useEffect} from "react";
import { redirect } from "next/navigation";
import InnForm from "@/app/components/InnForm";

export default function Create() {

    useEffect(() => {
        if (!haveJWT()) {
            return redirect("/");
        }
    }, []);

    return (
        <InnForm />
    )
}